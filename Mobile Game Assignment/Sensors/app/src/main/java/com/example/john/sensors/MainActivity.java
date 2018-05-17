package com.example.john.sensors;

import android.hardware.Sensor;
import android.hardware.SensorEvent;
import android.hardware.SensorManager;
import android.hardware.SensorEventListener;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity implements SensorEventListener
{
    Sensor accel;
    Sensor mag;
    float[]
    accelValues = new float[3],
    magValues = new float[3],
    orientations = new float[3],
    orientationMatrix = new float[16];

    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        SensorManager sMgr = (SensorManager) this.getSystemService(this.SENSOR_SERVICE);
        accel = sMgr.getDefaultSensor(Sensor.TYPE_ACCELEROMETER);
        mag = sMgr.getDefaultSensor(Sensor.TYPE_MAGNETIC_FIELD);
        sMgr.registerListener(this,accel, SensorManager.SENSOR_DELAY_UI);
        sMgr.registerListener(this,mag, SensorManager.SENSOR_DELAY_UI);

    }
    public void onSensorChanged(SensorEvent ev)
    {
        if(ev.sensor == accel)
        {
            accelValues = ev.values.clone();
        }
        else if (ev.sensor == mag)
        {
            magValues = ev.values.clone();
        }



        SensorManager.getRotationMatrix (orientationMatrix, null, accelValues, magValues);
        SensorManager.getOrientation(orientationMatrix, orientations);

        TextView x = (TextView) findViewById(R.id.xAxis);
        TextView y = (TextView) findViewById(R.id.yAxis);
        TextView z = (TextView) findViewById(R.id.zAxis);

        TextView a = (TextView) findViewById(R.id.azimuth);
        TextView p = (TextView) findViewById(R.id.pitch);
        TextView r = (TextView) findViewById(R.id.roll);

        x.setText("X Axis: " + String.valueOf(accelValues[0]));
        y.setText("Y Axis: " + String.valueOf(accelValues[1]));
        z.setText("Z Axis: " + String.valueOf(accelValues[2]));

        double azDeg = orientations[0]*(180/Math.PI);
        double piDeg = orientations[1]*(180/Math.PI);
        double roDeg = orientations[2]*(180/Math.PI);

        a.setText("Azimuth: " + String.valueOf(azDeg));
        p.setText("Pitch: " + String.valueOf(piDeg));
        r.setText("Roll: " + String.valueOf(roDeg));
    }

    public void onAccuracyChanged(Sensor sensor, int accuracy)
    {

    }
}
