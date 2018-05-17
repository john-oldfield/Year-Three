package com.example.john.multimedia;

import android.media.AudioManager;
import android.media.MediaPlayer;
import android.net.Uri;
import android.os.Bundle;
import android.os.Environment;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import java.io.File;

public class MainActivity extends AppCompatActivity
{
    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        Button play = (Button) findViewById(R.id.playBtn);
        Button pause = (Button) findViewById(R.id.pauseBtn);
        Button rewind = (Button) findViewById(R.id.rewindBtn);


        File mediaFile = new File(Environment.getExternalStorageDirectory().getAbsolutePath()+"/Movies/test.mp4");
        final MediaPlayer player = new MediaPlayer();
        player.setAudioStreamType(AudioManager.STREAM_MUSIC);

        try
        {
            player.setDataSource(getApplicationContext(), Uri.fromFile(mediaFile));
            player.setOnPreparedListener(new MediaPlayer.OnPreparedListener()
            {
                public void onPrepared(MediaPlayer mp)
                {
                    mp.start();
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

        play.setOnClickListener(new View.OnClickListener()
        {
            public void onClick(View v)
            {
                player.start();
            }
        });

        pause.setOnClickListener(new View.OnClickListener()
        {
            public void onClick(View v)
            {
                player.pause();
            }
        });

        rewind.setOnClickListener(new View.OnClickListener()
        {
            public void onClick(View v)
            {
                player.seekTo(10);
            }
        });

    }

}
