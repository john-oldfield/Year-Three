package com.example.john.a6permissions;

import android.Manifest;
import android.content.pm.PackageManager;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity implements View.OnClickListener
{

    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);



        Button grantBtn = (Button) findViewById(R.id.grantBtn);
        Button startBtn = (Button) findViewById(R.id.startBtn);

        grantBtn.setOnClickListener(this);
        startBtn.setOnClickListener(this);

    }

    public void onRequestPermissionsResult(int requestCode, String[] permissions, int[] grantResults)
    {
        switch(requestCode)
        {
            case 0:
                if(grantResults.length> 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED)
                {

                    new AlertDialog.Builder(this).setPositiveButton("OK", null).
                            setMessage("Now you can read files!").show();

                }
                else
                {
                    new AlertDialog.Builder(this).setPositiveButton("OK", null).
                            setMessage("Read file permission denied").show();
                }
                break;
        }
        showStatus();
    }

    public void showStatus()
    {
        TextView latText = (TextView) findViewById(R.id.latTxt);
        TextView lonText = (TextView) findViewById(R.id.lonTxt);

        latText.setText("Working...");
        lonText.setText("Working...");
    }

    @Override
    public void onClick(View v)
    {
        if(ContextCompat.checkSelfPermission(this, Manifest.permission.READ_EXTERNAL_STORAGE)==PackageManager.PERMISSION_GRANTED))
        {
            // read from file...

        }
        else
        {
            new AlertDialog.Builder(this).setPositiveButton("OK", null).
                    setMessage("No permission to read files!").show();
        }
    }
}
