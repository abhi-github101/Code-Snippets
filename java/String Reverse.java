import java.io.*;
import java.util.*;

public class Solution {

    public static void main(String[] args) {
        
        Scanner sc=new Scanner(System.in);
        String A=sc.next();
        int size=A.length();
        int half=(int)size/2;
        for(int i=0;i<half;i++){
            if(A.charAt(i)!=A.charAt(size-i-1)){
               System.out.println("No");
               return;
            }
            
        }
        System.out.println("Yes");
    }
}



