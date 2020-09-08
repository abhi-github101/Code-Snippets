import java.io.*;
import java.util.*;
import java.text.*;
import java.math.*;
import java.util.regex.*;
import java.security.*;
import java.nio.charset.StandardCharsets;

public class Solution {

    public static void main(String[] args) {

		Scanner scan=new Scanner(System.in);
        String input=scan.nextLine().trim();
        
        try{
			MessageDigest md = MessageDigest.getInstance("SHA-256");
			byte[] encodedHash = md.digest(input.getBytes(StandardCharsets.UTF_8));
			System.out.println(bytesToHex(encodedHash)); 
        }catch(Exception e){
            System.out.println(e);
        }
    }
		
    private static String bytesToHex(byte[] hash) {
		StringBuffer hexString = new StringBuffer();
		for (int i = 0; i < hash.length; i++) {
			String hex = Integer.toHexString(0xff & hash[i]);
			if(hex.length() == 1) hexString.append('0');
				hexString.append(hex);
		}
		return hexString.toString();
    }
    
}
