package com.example.john.sqlite;

import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.database.sqlite.SQLiteStatement;

import java.util.ArrayList;

/**
 * Created by John on 20/11/2017.
 */

public class MyHelper extends SQLiteOpenHelper
{
    static final int VERSION = 1;
    static final String DATABASE_NAME = "TestDB";

    public MyHelper(Context context)
    {
        super(context, DATABASE_NAME, null, VERSION);
    }

    @Override
    public void onCreate(SQLiteDatabase db)
    {
        db.execSQL("CREATE TABLE IF NOT EXISTS Song (ID INTEGER PRIMARY KEY, Title VARCHAR(255), Artist VARCHAR(255), Year INTEGER)");
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion)
    {

    }

    public Song findSong(int ID)
    {
        Song s = null;
        SQLiteDatabase db = getReadableDatabase();
        Cursor cursor = db.rawQuery ("SELECT * FROM Song WHERE ID=?",
                new String[] { ""+ID } );
        if (cursor.moveToFirst())
        {
             s = new Song
                (cursor.getString(cursor.getColumnIndex("Title")),
                        cursor.getString(cursor.getColumnIndex("Artist")),
                        cursor.getLong(cursor.getColumnIndex("Year")));
        }
        cursor.close();
        return s;
    }


    //ADD SONG
    public long insertRecord(String title, String artist, int year)
    {
        SQLiteDatabase db = getWritableDatabase();
        SQLiteStatement stmt = db.compileStatement
                ("INSERT INTO Song(Title,Artist,Year) VALUES (?, ?, ?)");
        stmt.bindString (1, title);
        stmt.bindString (2, artist);
        stmt.bindLong (3, year);
        long id = stmt.executeInsert();
        return id;
    }

    public int updateRecord(int ID, String title, String artist, int year)
    {
        SQLiteDatabase db = getWritableDatabase();
        SQLiteStatement stmt = db.compileStatement
                ("UPDATE Song SET Title=?, Artist=?, Year=? WHERE ID=?");
        stmt.bindString (1, title);
        stmt.bindString (2, artist);
        stmt.bindLong (3, year);
        stmt.bindLong (4, ID);

        int nAffectedRows = stmt.executeUpdateDelete();
        return nAffectedRows;
    }

    public int deleteRecord(int ID)
    {
        SQLiteDatabase db = getWritableDatabase();
        SQLiteStatement stmt = db.compileStatement
                ("DELETE FROM Song WHERE ID=?");
        stmt.bindLong (1, ID);
        int nAffectedRows = stmt.executeUpdateDelete();
        return nAffectedRows;

    }
}
