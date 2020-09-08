import java.io.*;
import java.util.*;
import java.text.*;
import java.math.*;
import java.util.regex.*;

public class Solution {

    static String isBalanced(String str) {
        ArrayList braces=new ArrayList();
        for(int i=0;i<str.length();i++){
            String s=str.substring(i,i+1);
			switch(s){
				case "{":
				case "[":
				case "(": braces.add(s);
					break;
				case "}": 
							if(braces.size()>0){
								if(braces.get(braces.size()-1).equals("{")){
									braces.remove(braces.size()-1);
								}else{
									return "NO";
								}
							}else{
								return "NO";
							}
					break;
				case "]": 
							if(braces.size()>0){
								if(braces.get(braces.size()-1).equals("[")){
									braces.remove(braces.size()-1);
								}else{
									return "NO";
								}
							}else{
								return "NO";
							}
					break;
				case ")":
							if(braces.size()>0){
								if(braces.get(braces.size()-1).equals("(")){
									braces.remove(braces.size()-1);
								}else{
									return "NO";
								}
							}else{
								return "NO";
							}
					break;
			}
		}
        
		if(braces.size()>0){
            return "NO";
        }
        return "YES";
    }

    public static void main(String[] args) {
        Scanner in = new Scanner(System.in);
        int t = in.nextInt();
        for(int a0 = 0; a0 < t; a0++){
            String s = in.next();
            String result = isBalanced(s);
            System.out.println(result);
        }
        in.close();
    }
}
