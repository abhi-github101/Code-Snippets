import java.util.*;
import java.text.*;

public class Solution {
    
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        double payment = scanner.nextDouble();
        scanner.close();
        
		String fPay=format(payment);
        Currency cur=Currency.getInstance(Locale.US);
        String us=cur.getSymbol(Locale.US)+fPay;
        String india="Rs."+fPay;
        cur=Currency.getInstance(Locale.CHINA);
        String china=cur.getSymbol(Locale.CHINA)+fPay;
        cur=Currency.getInstance(Locale.FRANCE);
        
		String france=franFormat(payment)+" "+cur.getSymbol(Locale.FRANCE);
        
        System.out.println("US: " + us);
        System.out.println("India: " + india);
        System.out.println("China: " + china);
        System.out.println("France: " + france);
    }
	
    static String format(double payment){
        NumberFormat nf=NumberFormat.getInstance();
        nf.setMinimumFractionDigits(2);
        nf.setMaximumFractionDigits(2);
    
		return nf.format(payment);
    }
	
    static String franFormat(double payment){
        NumberFormat nf=NumberFormat.getInstance(Locale.FRANCE);
        nf.setMinimumFractionDigits(2);
        nf.setMaximumFractionDigits(2);
        
		return nf.format(payment);
    }
    
}