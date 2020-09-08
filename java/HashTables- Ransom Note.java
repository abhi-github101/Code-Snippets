import java.io.*;
import java.math.*;
import java.security.*;
import java.text.*;
import java.util.*;
import java.util.concurrent.*;
import java.util.regex.*;

public class Solution {
	
	private static final Scanner scanner = new Scanner(System.in);

    static void checkMagazine(ArrayList<String> magazine, String[] note) {
        for(String word: note){
            if(magazine.contains(word)==false){
                System.out.println("No");
                return;
            }else{
                magazine.remove(word);
            }
        }
        
        System.out.println("Yes");

    }

    public static void main(String[] args) {
        String[] mn = scanner.nextLine().split(" ");

        int m = Integer.parseInt(mn[0]);

        int n = Integer.parseInt(mn[1]);
        String[] magazineItems = scanner.nextLine().split(" ");
        scanner.skip("(\r\n|[\n\r\u2028\u2029\u0085])?"); 

        String[] noteItems = scanner.nextLine().split(" ");
        scanner.skip("(\r\n|[\n\r\u2028\u2029\u0085])?");
        
        ArrayList<String> magHash=new ArrayList<String>();
        for(String word : magazineItems){
            magHash.add(word);
        }

        checkMagazine(magHash, noteItems);

        scanner.close();
    }
}
