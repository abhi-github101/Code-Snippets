import java.io.*;
import java.util.*;
import java.text.*;
import java.math.*;
import java.util.regex.*;
import java.lang.reflect.*;


class Singleton{
    
	private static Singleton INSTANCE=null;
    public String str;
    
	private Singleton(){
        str="Hello I am a singleton! Let me say hello world to you";
    }
    
	static Singleton getSingleInstance(){
        if(INSTANCE==null){
            INSTANCE=new Singleton();
        }
        return INSTANCE;
    }
}