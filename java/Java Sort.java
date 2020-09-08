import java.util.*;

class Student{
	private int id;
	private String fname;
	private double cgpa;
	
	public Student(int id, String fname, double cgpa) {
		//super();
		this.id = id;
		this.fname = fname;
		this.cgpa = cgpa;
	}
	
	public int getId() {
		return id;
	}
	
	public String getFname() {
		return fname;
	}
	
	public double getCgpa() {
		return cgpa;
	}
}

class Comp implements Comparator<Student>{
    
	public int compare(Student A,Student B){
        double cgpaA=A.getCgpa(),
			   cgpaB=B.getCgpa();
        if(cgpaA>cgpaB){
            return -1;
        }else if(cgpaA==cgpaB){
            String nameA=A.getFname(),
				   nameB=B.getFname();
            if(nameA.compareTo(nameB)<0){
                return -1;
            }else if(nameA.compareTo(nameB)>0){
                return 1;
            }else{
                int idA=A.getId(),
					idB=B.getId();
                if(idA<idB){
                    return -1;
                }else{
                    return 1;
                }
            }
        }else{
            return 1;
        }
        
    }
}

public class Solution
{
	public static void main(String[] args){
		Scanner in = new Scanner(System.in);
		int testCases = Integer.parseInt(in.nextLine());
		
		List<Student> studentList = new ArrayList<Student>();
		while(testCases>0){
			int id = in.nextInt();
			String fname = in.next();
			double cgpa = in.nextDouble();
			
			Student st = new Student(id, fname, cgpa);
			studentList.add(st);
			
			testCases--;
		}

        Collections.sort(studentList,new Comp());
      	for(Student st: studentList){
			System.out.println(st.getFname());
		}
	}
}
