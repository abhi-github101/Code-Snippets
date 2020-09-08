import java.io.*;
import java.util.*;
import java.text.*;
import java.math.*;
import java.util.regex.*;
import java.security.*;
import javax.xml.bind.DatatypeConverter;

public class Solution {

    public static void main(String[] args) {
        
		Scanner scan=new Scanner(System.in);
        String input=scan.nextLine().trim();
        try{
			MessageDigest md=MessageDigest.getInstance("MD5");
			md.update(input.getBytes());
			byte[] digest=md.digest();
			String hash=DatatypeConverter.printHexBinary(digest).toLowerCase();
			System.out.println(hash);
        }catch(Exception e){
            System.out.println(e);
        }
    }
}
