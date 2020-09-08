import java.util.Scanner;

public class Solution {

    static boolean isAnagram(String A, String B) {

		int occ[]=new int[26];
        for(int i=0;i<26;i++){
            occ[i]=0;
        }
        
        int sizeA=A.length();
        for(int i=0;i<sizeA;i++){
            char c=A.charAt(i);
            int ascii=(int)c;
            if(ascii>=65&&ascii<=90){
				occ[ascii-65]++;
            }else{
				occ[ascii-97]++;
            }    
        }
        
        int sizeB=B.length();
        for(int i=0;i<sizeB;i++){
            char c=B.charAt(i);
            int ascii=(int)c;
            if(ascii>=65&&ascii<=90){
				occ[ascii-65]--;
            }else{
				occ[ascii-97]--;
            }
        }
		
        boolean anagram=true;
        for(int i=0;i<26;i++){
            if(occ[i]!=0){
                anagram=false;
                break;
            }
        }
        
		return anagram;
    }

	public static void main(String[] args) {
    
        Scanner scan = new Scanner(System.in);
        String a = scan.next();
        String b = scan.next();
        scan.close();
        boolean ret = isAnagram(a, b);
        System.out.println( (ret) ? "Anagrams" : "Not Anagrams" );
    }
}