import java.util.Scanner;

public class PasswordCheck {
    public static String password = "HackTrinity{When_You_Lose_The_Code_You_Lose_Your_Secrets}";
    
    public static void main(String[] args) {
        Scanner s = new Scanner(System.in);
        System.out.printf("Enter password: ");
        String guess = s.nextLine();
        if (guess.equals(password)) {
            System.out.println("Congrats, that was the flag!");
        } else {
            System.out.println("Oops, that's not the flag!");
        }
    }
}
