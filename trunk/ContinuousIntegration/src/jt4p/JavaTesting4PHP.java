package jt4p;

import java.io.*;
import java.net.URL;
import java.util.Arrays;

/**
 * Created by IntelliJ IDEA.
 * User: Administrador
 * Date: 18-ago-2010
 * Time: 17:19:13
 */
public class JavaTesting4PHP {

    public static void main(String[] args) {
        checkArgs(args);
        new JavaTesting4PHP(new File(args[0]));
    }

    private String baseURL;

    public JavaTesting4PHP(File root) {
        baseURL = loadConfig(root);
        runTests(root, baseURL);
    }

    private void runTests(File folder, String baseURL) {
        executeHooks(baseURL, folder.listFiles(SETUP_FILTER));
        executeTests(baseURL, folder.listFiles(TEST_FILTER));
        executeHooks(baseURL, folder.listFiles(TEARDOWN_FILTER));
        
        runTestsOnFolders(baseURL, folder.listFiles(FOLDERS_FILTER));
    }

    private void executeHooks(String baseURL, File[] tests) {
        for (File test : tests) {
            runHook(createURL(baseURL, test));
        }
    }

    private void executeTests(String baseURL, File[] tests) {
        for (File test : tests) {
            runTest(createURL(baseURL, test));
        }
    }

    private void runHook(String hook) {
        try {
            URL resource = new URL(hook);
            InputStream st = resource.openStream();
            BufferedReader reader = new BufferedReader(new InputStreamReader(st));
            String line;
            while((line = reader.readLine()) != null) {}
        } catch (IOException e) {
            e.printStackTrace();
            exit(e.getMessage(), 2);
        }
    }

    private void runTest(String test) {
        try {
            URL resource = new URL(test);
            InputStream st = resource.openStream();
            BufferedReader reader = new BufferedReader(new InputStreamReader(st));
            String line = reader.readLine();
            if(line != null) {
                StringBuilder builder = new StringBuilder();
                createErrorHeader(builder, test);
                builder.append(line+'\n');
                while((line = reader.readLine()) != null) {
                    builder.append(line);
                }
                exit(builder.toString(), 1);
            }
        } catch (IOException e) {
            e.printStackTrace();
            exit(e.getMessage(), 2);
        }
    }

    private void createErrorHeader(StringBuilder builder, String test) {
        builder.append("Error in test '");
        builder.append(test.substring(baseURL.length()));
        builder.append("'.\n");
    }

    private void runTestsOnFolders(String baseURL, File[] folders) {
        for (File folder : folders) {
            runTests(folder, createURL(baseURL, folder));
        }
    }

    private String createURL(String base, File file) {
        return base + "/" + file.getName();
    }

    private String loadConfig(File root) {
        BufferedReader reader = null;
        try {
            reader = new BufferedReader(new FileReader(new File(root, "config.txt")));
        } catch (IOException e) {
            exit("No configuration file found.", 2);
        }
        try {
            return reader.readLine();
        } catch (IOException e) {
            exit("Invalid configuration file.", 2);
        } finally {
            try {
                reader.close();
            } catch (IOException ignore) {}
        }
        return null;
    }


    private static void checkArgs(String[] args) {
        if(args.length != 1) {
            exit("You must specify the tests directory", 1);
        }
    }

    private static void exit(String message, int code) {
        System.out.println(message);
        System.exit(code);
    }

    private static FileFilter FOLDERS_FILTER = new FileFilter(){
        public boolean accept(File pathname) {
            return pathname.isDirectory();
        }
    };

    private static FileFilter TEST_FILTER = new FileFilter(){
        public boolean accept(File pathname) {
            return pathname.isFile() && pathname.getName().endsWith("Test.php");
        }
    };

    private static FileFilter SETUP_FILTER = new FileFilter(){
        public boolean accept(File pathname) {
            return pathname.isFile() && pathname.getName().endsWith("Setup.php");
        }
    };

    private static FileFilter TEARDOWN_FILTER = new FileFilter(){
        public boolean accept(File pathname) {
            return pathname.isFile() && pathname.getName().endsWith("Teardown.php");
        }
    };
}
