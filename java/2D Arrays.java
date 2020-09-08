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
        int[][] arr = new int[6][6];

        for (int i = 0; i < 6; i++) {
            String[] arrRowItems = scanner.nextLine().split(" ");
            scanner.skip("(\r\n|[\n\r\u2028\u2029\u0085])?");

            for (int j = 0; j < 6; j++) {
                int arrItem = Integer.parseInt(arrRowItems[j]);
                arr[i][j] = arrItem;
            }
        }
        System.out.println(calculateHourSum(arr));
        scanner.close();
    }

    static int calculateHourSum(int[][] A){
        int sum=-99999;
        for(int i=0;i<4;i++){
            for(int j=0;j<4;j++){
                int temp=A[i][j]  + A[i][j+1]   + A[i][j+2] +
                                    A[i+1][j+1] +
                         A[i+2][j]+ A[i+2][j+1] + A[i+2][j+2] ;
                if(temp>sum){
                    sum=temp;
                }
            }
        }
        return sum;
    }
}
