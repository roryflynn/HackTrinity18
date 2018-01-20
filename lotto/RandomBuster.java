import java.util.Random;

public class RandomBuster {
    //used internally by Random to generate the next numbers                                                                                                                                                
    private static final long multiplier = 0x5DEECE66DL;
    private static final long addend = 0xBL;
    private static final long mask = (1L << 48) - 1;

    //the seed. If we find the seed, we can predict the 'random' numbers                                                                                                                                    
    private static Long seed;

    //the random number we will be busting                                                                                                                                                                  
    private static Random random = new Random();

    //how many iterations did we need?                                                                                                                                                                      
    private static int iterations = 1;

    public static void main(String[] args) {
        //findSeed(random.nextInt());
        findSeed(Integer.parseInt(args[0]), Integer.parseInt(args[1]));
        System.out.println();

        //now that we know the seed, we can find the next integer                                                                                                                                           
        predictNext(32); // calculated seed is for v1. This gets us to v2                                                                                                                                   
        System.out.println("Predicted nextInt: " + predictNext(32));  //predicted v3                                                                                                                        
        System.out.println("   Random.nextInt: " + random.nextInt()); //actual v3                                                                                                                           
    }
    protected static synchronized void findSeed(long v1, long v2) {
        //long v2 = random.nextInt();
        for (int i = 0; i < 65536; i++) {
            seed = v1 * 65536 + i;
            if ((((seed * multiplier + addend) & mask) >>> 16) == v2) {
                System.out.println();
                System.out.println("Seed found: " + seed + " in " + iterations + " iterations");
                break;
            }
            seed = null;
        }

        //if we haven't found it yet, loop through again                                                                                                                                                    
        iterations++;
        if (seed == null) findSeed(v2, 0);
    }

    protected static synchronized int predictNext(int bits) {
        seed = (seed * multiplier + addend) & mask;
        return (int) (seed >>> (48 - bits));
    }
}
