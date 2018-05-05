package com.example.john.sqlite;

/**
 * Created by John on 20/11/2017.
 */

public class Song
{
    String title;
    String artist;
    long year;

    public Song(String t, String a, long y)
    {
        title = t;
        artist = a;
        year = y;
    }

    public String getTitle()
    {
        return title;
    }

    public void setTitle(String title)
    {
        this.title = title;
    }

    public String getArtist()
    {
        return artist;
    }

    public void setArtist(String artist)
    {
        this.artist = artist;
    }

    public long getYear()
    {
        return year;
    }

    public void setYear(long year)
    {
        this.year = year;
    }
}
