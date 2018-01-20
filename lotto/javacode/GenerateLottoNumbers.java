import java.util.Random;

public class GenerateLottoNumbers {
	/* Output 1st, 2nd and 3rd Lotto numbers to stdout.*/
	public static void main(String[] args) {
		Random r = new Random();
		System.out.println(r.nextInt());
		System.out.println(r.nextInt());
		System.out.println(r.nextInt());
	}
}