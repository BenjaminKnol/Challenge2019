import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.time.LocalDateTime;

public class PostgreSQL {

    private final String url = "jdbc:postgresql://localhost/birdstay";
    private final String user = "postgres";
    private final String password = "root";
    private BirdGps payload;

    public PostgreSQL(BirdGps birdGps) {
        this.payload = birdGps;
    }

    public Connection connect() {
        Connection conn = null;
        try {
            conn = DriverManager.getConnection(url, user, password);
            Statement state = conn.createStatement();
            ResultSet rs = state.executeQuery("SELECT id FROM locations ORDER BY id DESC LIMIT 1");
            long latestlocationId=0;
            while(rs.next()){
                latestlocationId= rs.getLong(1);
            }
            latestlocationId++;
            PreparedStatement st = conn.prepareStatement("INSERT INTO locations VALUES( ?, ?, ?, ?, ?, ?, ?)");

            st.setObject(1, latestlocationId);
            st.setObject(2, payload.getTrackerID());
            st.setObject(3, payload.getGpsLong());
            st.setObject(4, payload.getGpsLat());
            st.setObject(5, payload.getDate());
            st.setObject(6, LocalDateTime.now());
            st.setObject(7, LocalDateTime.now());
            st.executeUpdate();
            st.close();
        } catch (SQLException e) {
            System.out.println(e.getMessage());
        }
        return conn;
    }

    public static void main(String[] args) {
        PostgreSQL app = new PostgreSQL(new BirdGps(LocalDateTime.now(), "lol", 50.0, 50.0));
        app.connect();
    }
}
