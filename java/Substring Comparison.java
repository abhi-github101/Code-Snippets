import java.util.Scanner;

public class Solution {


	public static String getSmallestAndLargest(String s, int k) {
        String smallest = "";
        String largest = "";
        // 'smallest' must be the lexicographically smallest substring of length 'k'
        // 'largest' must be the lexicographically largest substring of length 'k'
        String subArr[]=new String[s.length()-k+1];
        for(int i=0;i<s.length()-k+1;i++){
            subArr[i]=s.substring(i,i+k);
        }
            
		sort(subArr);
        smallest=subArr[0];
        largest=subArr[subArr.length-1];
        return smallest + "\n" + largest;
    }

	static void sort(String subArr[]){
		for(int i=0;i<subArr.length;i++){
			for(int j=0;j<subArr.length-i-1;j++){
				if(subArr[j].compareTo(subArr[j+1])>0){
					String temp=subArr[j];
					subArr[j]=subArr[j+1];
					subArr[j+1]=temp;
				}
			}
		}
	}


    public static void main(String[] args) {
        Scanner scan = new Scanner(System.in);
        String s = scan.next();
        int k = scan.nextInt();
        scan.close();
      
        System.out.println(getSmallestAndLargest(s, k));
    }
}