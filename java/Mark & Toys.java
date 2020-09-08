import java.io.*;
import java.math.*;
import java.security.*;
import java.text.*;
import java.util.*;
import java.util.concurrent.*;
import java.util.regex.*;

public class Solution {

    private static final Scanner scanner = new Scanner(System.in);

	static int maximumToys(int[] prices, int k) {
        Arrays.sort(prices);
        int spend=0;
        int toys=0;
        int len=prices.length;
        int i=0;
        while(spend<=k&&i<len){
            int temp=spend+prices[i];    
            if(temp<=k){
                spend+=prices[i];
                toys++;
            }
            i++;
		}
		return toys;
    }

    public static void main(String[] args) throws IOException {
        BufferedWriter bufferedWriter = new BufferedWriter(new FileWriter(System.getenv("OUTPUT_PATH")));
		String[] nk = scanner.nextLine().split(" ");
		int n = Integer.parseInt(nk[0]);
		int k = Integer.parseInt(nk[1]);
		int[] prices = new int[n];
		String[] pricesItems = scanner.nextLine().split(" ");
        scanner.skip("(\r\n|[\n\r\u2028\u2029\u0085])?");

        for (int i = 0; i < n; i++) {
            int pricesItem = Integer.parseInt(pricesItems[i]);
            prices[i] = pricesItem;
        }

        int result = maximumToys(prices, k);

        bufferedWriter.write(String.valueOf(result));
        bufferedWriter.newLine();
		bufferedWriter.close();

        scanner.close();
    }
}
