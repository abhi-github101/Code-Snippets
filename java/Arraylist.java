import java.io.*;
import java.util.*;
import java.text.*;
import java.math.*;
import java.util.regex.*;

public class Solution {

    public static void main(String[] args) {
    
    Scanner scan=new Scanner(System.in);
        int n=scan.nextInt();
        ArrayList<Integer[]> arr=new ArrayList(n);

        for(int i=0;i<n;i++){
            int m=scan.nextInt();
            Integer subArr[]=new Integer[m];
            for(int j=0;j<m;j++){
                subArr[j]=scan.nextInt();
            }
            arr.add(subArr);
        }

        int query=scan.nextInt();
        for(int i=0;i<query;i++){
            int line=scan.nextInt();
            int ind=scan.nextInt();
            try{
                Integer[] resArr=arr.get(line-1);
                System.out.println(resArr[ind-1]);
            }catch(Exception e){
                System.out.println("ERROR!");
            }
        }
        scan.close();
    }
}