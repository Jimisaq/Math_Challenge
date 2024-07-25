import javax.mail.MessagingException;
import javax.mail.PasswordAuthentication;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeMessage;
import java.util.Properties;

public class EmailSender {
    static String sender = "jimisaac8082@gmail.com";
    static Properties properties = System.getProperties();
    static {
        properties.put("mail.smtp.auth", true);
        properties.put("mail.smtp.starttls.enable", true);
        properties.put("mail.smtp.host", "smtp.gmail.com");
        properties.put("mail.smtp.port", "587");
        properties.put("mail.smtp.ssl.protocols", "TLSv1.2");
    }

    // send email to school representative after a pupil has registered
    public static void notifySchoolRep(String schoolRegNo, String pupilName) {
        String recipient = Model.getSchoolRepEmail(schoolRegNo);

        Session session = Session.getInstance(properties, new javax.mail.Authenticator() {
            protected PasswordAuthentication getPasswordAuthentication() {
                return new PasswordAuthentication("jimisaac8082@gmail.com", "wnza cduy pqch ydyw");
            }
        });
        try {
            MimeMessage message = new MimeMessage(session);
            message.setFrom(new InternetAddress(sender));
            message.addRecipient(MimeMessage.RecipientType.TO, new InternetAddress(recipient));
            message.setSubject("New Pupil Registration");
            message.setText("A new pupil by the name " + pupilName
                    + " has registered in your school,,log into the system to confirm their registration");
            Transport.send(message);
            System.out.println("email sent successfully...");
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }
    }

    // send email to pupil after their registration has been confirmed
    public static void notifyPupil(String recipient, String subject, String info) {

        Session session = Session.getInstance(properties, new javax.mail.Authenticator() {
            protected PasswordAuthentication getPasswordAuthentication() {
                return new PasswordAuthentication("jimisaac8082@gmail.com", "wnza cduy pqch ydyw");
            }
        });
        try {
            MimeMessage message = new MimeMessage(session);
            message.setFrom(new InternetAddress(sender));
            message.addRecipient(MimeMessage.RecipientType.TO, new InternetAddress(recipient));
            message.setSubject(subject);
            message.setText(info);
            Transport.send(message);
            System.out.println("email sent succesfully...");
        } catch (MessagingException e) {
            System.out.println(e.getMessage());
        }

    }

    private static final ScheduledExecutorService scheduler = Executors.newSingleThreadScheduledExecutor();

    public static void sendChallengeReport(String recipient, List<ChallengeAttempt> attempts) {
        StringBuilder report = new StringBuilder();
    //send a detailed report to pupils who participate in challenges after the deadline has passed
    public static void sendChallengeReport(String recipient, List<ChallengeAttempt> attempts) {
        StringBuilder report = new StringBuilder();

        report.append("Challenge Report\n");
        report.append("-----------------\n");
        report.append("Email | Username | First Name\n");
        report.append("-----------------\n");

        for (ChallengeAttempt attempt : attempts) {
            report.append(attempt.getEmail()).append(" | ").append(attempt.getUsername()).append(" | ").append(attempt.getFirstName()).append("\n");
            report.append("-----------------\n");

            report.append("Question | Score | Time Taken\n");
            report.append("-----------------\n");
            for (QuestionAttempt questionAttempt : attempt.getQuestionAttempts()) {
                report.append(questionAttempt.getQuestion()).append(" | ").append(questionAttempt.getScore()).append(" | ").append(questionAttempt.getTimeTaken()).append("\n");
                report.append("-----------------\n");
            }

            report.append("Total Time Taken: ").append(attempt.getTotalTimeTaken()).append("\n");
            report.append("-----------------\n");
        }

        scheduler.schedule(() -> {
            sendReport(recipient, report.toString());
        }, 1, TimeUnit.DAYS); // Adjust the delay and time unit as needed
    }

        Session session = Session.getInstance(properties, new javax.mail.Authenticator() {
            protected PasswordAuthentication getPasswordAuthentication() {
                return new PasswordAuthentication("jimisaac8082@gmail.com", "wnza cduy pqch ydyw");
            }
        });
        try {
            MimeMessage message = new MimeMessage(session);
            message.setFrom(new InternetAddress(sender));
            message.addRecipient(MimeMessage.RecipientType.TO, new InternetAddress(recipient));
            message.setSubject("Challenge Report");
            message.setText(report.toString());
            Transport.send(message);
            System.out.println("Report sent successfully...");
        } catch (MessagingException e) {
            System.out.println(e.getMessage());
        }
    }
}