package com.example.john.sqlite;

import android.content.Intent;
import android.support.design.widget.FloatingActionButton;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity
{
    MyHelper helper;

    @Override
    protected void onCreate(Bundle savedInstanceState)
    {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        setContentView(R.layout.activity_main);

        helper = new MyHelper(this);

        Button add = (Button) findViewById(R.id.add_btn);
        Button search = (Button) findViewById(R.id.search_btn);
        Button delete = (Button) findViewById(R.id.delete_btn);
        Button update = (Button) findViewById(R.id.update_btn);

        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab1);
        fab.setOnClickListener (new View.OnClickListener()
        {

            public void onClick(View view)
            {
                Intent intent = new Intent(MainActivity.this, AddSongActivity.class);
                startActivity(intent);
            }
        });
       /* add.setOnClickListener(new View.OnClickListener()
        {
            public void onClick(View v)
            {
                EditText title = (EditText) findViewById(R.id.title_input);
                EditText artist = (EditText) findViewById(R.id.artist_input);
                EditText year = (EditText) findViewById(R.id.year_input);

                helper.insertRecord(title.getText().toString(), artist.getText().toString(), Integer.parseInt(year.getText().toString()));
                Toast.makeText(MainActivity.this, "Song Added", Toast.LENGTH_LONG).show();
            }
        });*/

        search.setOnClickListener(new View.OnClickListener()
        {
            public void onClick(View v)
            {
                EditText id = (EditText) findViewById(R.id.ID_input);
                EditText title = (EditText) findViewById(R.id.title_input);
                EditText artist = (EditText) findViewById(R.id.artist_input);
                EditText year = (EditText) findViewById(R.id.year_input);

                int ID = Integer.parseInt(id.getText().toString());
                Song s = helper.findSong(ID);
                if(s == null)
                {
                    Toast.makeText(MainActivity.this, "Song Not Found", Toast.LENGTH_LONG).show();
                }
                else
                {
                    title.setText(s.getTitle());
                    artist.setText(s.getArtist());
                    Long yr = s.getYear();
                    String yr_str = String.valueOf(yr);
                    year.setText(yr_str);
                }
            }
        });

        /*delete.setOnClickListener(new View.OnClickListener()
        {
            public void onClick(View v)
            {
                EditText id = (EditText) findViewById(R.id.ID_input);
                int i = Integer.parseInt(id.getText().toString());
                int nrows = helper.deleteRecord(i);
                if(nrows == 1)
                {
                    Toast.makeText(MainActivity.this, "Song Deleted", Toast.LENGTH_LONG).show();
                }
                else
                {
                    Toast.makeText(MainActivity.this, "Song does not exist.", Toast.LENGTH_LONG).show();
                }
            }
        });

        update.setOnClickListener(new View.OnClickListener()
        {
            public void onClick(View v)
            {
                EditText id = (EditText) findViewById(R.id.ID_input);
                EditText title = (EditText) findViewById(R.id.title_input);
                EditText artist = (EditText) findViewById(R.id.artist_input);
                EditText year = (EditText) findViewById(R.id.year_input);

                int i = Integer.parseInt(id.getText().toString());
                String t = title.getText().toString();
                String a = artist.getText().toString();
                int y = Integer.parseInt(year.getText().toString());

                int nrows = helper.updateRecord(i, t, a, y);

                if(nrows == 1)
                {
                    Toast.makeText(MainActivity.this, "Song Updated.", Toast.LENGTH_LONG).show();

                }
                else
                {
                    Toast.makeText(MainActivity.this, "Song Does not exist.", Toast.LENGTH_LONG).show();
                }
            }
        });*/
    }
}
