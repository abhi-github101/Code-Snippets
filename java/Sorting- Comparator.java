import java.util.*;

class Player {
	String name;
	int score;

	Player(String name, int score) {
		this.name = name;
		this.score = score;
	}
}

class Checker implements Comparator<Player> {

	public int compare(Player a, Player b) {
		int scoreA=a.score;
		int scoreB=b.score;
		String nameA=a.name;
		String nameB=b.name;
    
		if(scoreA>scoreB){
			return -1;
		}else if(scoreA==scoreB){
			if(nameA.compareTo(nameB)<0){
				return -1;
			}else if(nameA.compareTo(nameB)>0){
				return 1;
			}else{
				return 0;
			}
		}
        return 1;
    }
}

public class Solution {

    public static void main(String[] args) {
        Scanner scan = new Scanner(System.in);
        int n = scan.nextInt();

        Player[] player = new Player[n];
        Checker checker = new Checker();
        
        for(int i = 0; i < n; i++){
            player[i] = new Player(scan.next(), scan.nextInt());
        }
        scan.close();

        Arrays.sort(player, checker);
        for(int i = 0; i < player.length; i++){
            System.out.printf("%s %s\n", player[i].name, player[i].score);
        }
    }
}
