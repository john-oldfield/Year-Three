package com.example.john.video;

import android.media.AudioManager;
import android.media.MediaPlayer;
import android.net.Uri;
import android.os.Environment;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.SurfaceHolder;
import android.view.SurfaceView;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import java.io.File;

public class MainActivity extends AppCompatActivity implements SurfaceHolder.Callback
{
    MediaPlayer player = new MediaPlayer();


    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        Button pause = (Button) findViewById(R.id.pauseBtn);
        Button play = (Button) findViewById(R.id.playBtn);
        Button rewind = (Button) findViewById(R.id.rewindBtn);
        pause.setOnClickListener(new View.OnClickListener()
        {
            public void onClick(View v)
            {
                player.pause();
            }
        });
        play.setOnClickListener(new View.OnClickListener()
        {
            public void onClick(View v)
            {
                player.start();
            }
        });
        rewind.setOnClickListener(new View.OnClickListener()
        {
            public void onClick(View v)
            {
                player.seekTo(10);
            }
        });

        final SurfaceView sv = (SurfaceView) findViewById(R.id.video);
        sv.getHolder().addCallback(this);
        File mediaFile = new File(Environment.getExternalStorageDirectory().getAbsolutePath() + "/Movies/test.mp4");
        player.setAudioStreamType(AudioManager.STREAM_MUSIC);

        try
        {
            player.setDataSource(getApplicationContext(), Uri.fromFile(mediaFile));
            player.setOnPreparedListener(new MediaPlayer.OnPreparedListener()
            {
                public void onPrepared(MediaPlayer mp)
                {
                    mp.setDisplay(sv.getHolder());
                    Toast.makeText(MainActivity.this, "Playing multimedia...", Toast.LENGTH_SHORT).show();
                }
            });

            player.prepareAsync();
        }
        catch (Exception e)
        {
            new AlertDialog.Builder(this).setPositiveButton("OK", null).
                    setMessage(e.toString()).show();
            e.printStackTrace();
        }
    }

    public void surfaceCreated(SurfaceHolder holder)
    {
        player.start();
    }

    @Override
    public void surfaceChanged(SurfaceHolder holder, int format, int width, int height) {

    }

    @Override
    public void surfaceDestroyed(SurfaceHolder holder) {

    }


}
