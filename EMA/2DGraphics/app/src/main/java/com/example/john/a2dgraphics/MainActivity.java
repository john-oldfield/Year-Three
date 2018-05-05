package com.example.john.a2dgraphics;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

public class MainActivity extends AppCompatActivity
{
    GraphicsView gv;

    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        gv = new GraphicsView(this);
        setContentView(gv);
    }
}

