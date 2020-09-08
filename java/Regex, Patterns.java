import java.io.*;
import java.math.*;
import java.security.*;
import java.text.*;
import java.util.*;
import java.util.concurrent.*;
import java.util.regex.*;
import java.util.*;

public class Solution {

    private static final Scanner scanner = new Scanner(System.in);

    public static void main(String[] args) {
        int N = scanner.nextInt();
        scanner.skip("(\r\n|[\n\r\u2028\u2029\u0085])?");
        String[] names=new String[N];
        String[] emails=new String[N];
        
		for (int NItr = 0; NItr < N; NItr++) {
            String[] firstNameEmailID = scanner.nextLine().split(" ");
			String firstName = firstNameEmailID[0];
			String emailID = firstNameEmailID[1];
            names[NItr]=firstName;
            emails[NItr]=emailID;
        }
		
        ArrayList<String> result=new ArrayList();
        for(int i=0;i<N;i++){
            if(emails[i].indexOf("@gmail.com")>-1){
                result.add(names[i]);
            }
        }
		
        Collections.sort(result);
        for(int i=0;i<result.size();i++){
            System.out.println(result.get(i).toString());
        }

        scanner.close();
    }
}
