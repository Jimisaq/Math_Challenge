import java.io.BufferedReader;
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.*;
import java.time.Duration;
import java.time.LocalDateTime;
import java.time.LocalTime;

public class Question {
    private int question_no;
    private String question_text;
    private int answer;
    private int marks;

    //Constructor
    public Question(int question_no, String question_text, int answer, int marks) {
        this.question_no = question_no;
        this.question_text = question_text;
        this.answer = answer;
        this.marks = marks;
    }

    //setters
    public void setQuestion_no(int question_no) {
        this.question_no = question_no;
    }

    public void setQuestion_text(String question_text) {
        this.question_text = question_text;
    }

    public void setAnswer(int answer) {
        this.answer = answer;
    }

    public void setMarks(int marks) {
        this.marks = marks;
    }

    //Getter
    public int getQuestion_no() {
        return question_no;
    }

    public String getQuestion_text() {
        return question_text;
    }

    public int getAnswer() {
        return answer;
    }

    public int getMarks() {
        return marks;
    }


    public static int[] retrieveQuestion(PrintWriter printWriter, BufferedReader br,int challengeNumber,int participantId,LocalDateTime start) throws IOException {
        char status='N';
        int score=0;
        int totalQuestionsDone = 1;
        int questionsPassed = 0;
        int questionsFailed = 0;
        int complete = 1;
        int[] report = new int[5];

        try(Connection conn = Model.createConnection();){

            System.out.println(challengeNumber);
            String sql = "SELECT * from questions where challenge_no = ? ORDER BY RAND() LIMIT 10";
            PreparedStatement stmt = conn.prepareStatement(sql);
            stmt.setInt(1, challengeNumber);
            ResultSet rs = stmt.executeQuery();


            //get challenge duration
            int duration = Model.getChallengeDuration(challengeNumber);


            while (rs.next()){

                    LocalDateTime rightNow = LocalDateTime.now();
                    Duration timeElapsed = Duration.between(start, rightNow);

                    Duration timeLimit = Duration.ofMinutes(duration);

                    if (timeElapsed.compareTo(timeLimit) > 0) {
                        printWriter.println("TIME UP!");
                        complete=0;
                        break;
                    }
                    Duration timeRemaining = timeLimit.minus(timeElapsed);
                    String jep = ("Time left: " + timeRemaining.toMinutes() + ":" + timeRemaining.toSecondsPart() +":" +timeRemaining.toMillisPart());
                    printWriter.println(jep);
                    int count = 10-totalQuestionsDone;
                    printWriter.println("Questions left: " +count);

                //displaying question on the client
                        printWriter.println(rs.getString("question_text"));
                        printWriter.println();

                        //receiving answer from the pupil
                        String ans = br.readLine();
                        if (ans.equals(rs.getString("answer"))) {
                            printWriter.println("Correct!");
                            status = 'C';
                            score += rs.getInt("marks");
                            questionsPassed++;
                        } else if(ans.isEmpty()){
                            printWriter.println("No answer supplied");
                            status = 'N';
                            score +=0;
                        } else{

                            printWriter.println("Incorrect!");
                            status = 'I';
                            score -=3;
                            questionsFailed++;


                        }
                        printWriter.println("-----------------------------------");
                        printWriter.println("-----------------------------------");
                //record attempted question
                Model.recordAttemptedQuestion(challengeNumber, participantId, start,rs.getInt("question_no"),status);


//if the questions are done, break out of the loop
                if(totalQuestionsDone>=10){
                    break;
                }

                    totalQuestionsDone++;
            }

        }catch (SQLException e){
            System.out.println(e.getMessage());
        };
        //Eliminate negative marks
        if(score<0){
            score=0;
        }
        report[0] = score;
        report[1] = questionsPassed;
        report[2] = questionsFailed;
        report[3] = totalQuestionsDone;
        report[4] = complete;

        return report;
    }
}
