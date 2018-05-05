package com.example.john.a2dgraphics;

import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.text.method.Touch;
import android.view.MotionEvent;
import android.view.View;
import android.graphics.Canvas;
import android.graphics.Paint;
import android.graphics.Color;
import android.content.Context;

public class GraphicsView extends View implements View.OnTouchListener
{

    Canvas c;
    Bitmap heroBmp;
    Paint p;
    int counter;
    public GraphicsView (Context ctx)
    {
        super(ctx);
        this.setOnTouchListener(this);

        heroBmp = BitmapFactory.decodeResource(ctx.getResources(), R.drawable.hero);

        p = new Paint();
        p.setColor(Color.RED);
        p.setTextSize(24);
    }

    public void onDraw (Canvas canvas)
    {
        counter = counter + 1;
        canvas.drawText("The screen has been refreshed " + counter + " times.", 20, 200, p);
    }

    public boolean onTouch(View v, MotionEvent event)
    {
        float x = event.getX();
        float y = event.getY();
        c.drawBitmap(heroBmp, x, y, null);
        return false;
    }
}
