import java.io.*;
import java.math.*;
import java.security.*;
import java.text.*;
import java.util.*;
import java.util.concurrent.*;
import java.util.regex.*;

public class Solution {

    private static final Scanner scanner = new Scanner(System.in);

    public static void main(String[] args) {
        int n = scanner.nextInt();
        scanner.skip("(\r\n|[\n\r\u2028\u2029\u0085])?");
        String binary=getBinaryRepr(n);
        System.out.println(consecutiveOnes(binary));
        scanner.close();
    }
	
    static String getBinaryRepr(int n){
        String bin="";
        int rem=0;
        int quo=n;
        while(quo>1){
            rem=quo%2;
            quo=(int)quo/2;
            bin=rem+""+bin;
        }
        bin="1"+bin;
        return bin;
    }
	
    static int consecutiveOnes(String bin){
        String ones="1";
        int count=0;        
        while(bin.contains(ones)){
            count++;
            ones+="1";
        }
        return count;
    }
}
