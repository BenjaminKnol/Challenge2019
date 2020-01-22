//https://www.hivemq.com/blog/mqtt-client-library-encyclopedia-eclipse-paho-java/
//https://www.eclipse.org/paho/clients/java/


import org.eclipse.paho.client.mqttv3.*;
import org.eclipse.paho.client.mqttv3.persist.MemoryPersistence;

import java.text.SimpleDateFormat;
import java.time.LocalDateTime;
import java.util.Arrays;
import java.util.Date;


public class MQTT implements MqttCallback {

    private String serverUrl;


    public MQTT(boolean TLS, String protocol, String host, MqttConnectOptions MQTToptions) throws Exception {

        int port;
        if (TLS) {
            port = 8883;
        } else {
            port = 1883;
        }

        serverUrl = protocol + "://" + host + ":" + Integer.toString(port);

        System.out.println("time to inisilize");

        MqttClient client = new MqttClient(

                serverUrl, //URI
                /*"tcp://broker.mqttdashboard.com:1883",*/

                MqttClient.generateClientId(), //ClientId
                new MemoryPersistence()); //Persistence


        client.setCallback(new MqttCallback() {

            //@Override
            public void connectionLost(Throwable cause) { //Called when the client lost the connection to the broker
            }

            //@Override
            public void messageArrived(String topic, MqttMessage message) throws Exception {

                //System.out.println(topic + ": " + Arrays.toString(message.getPayload()));
                System.out.println("Recived somthing");
                String string = new String(message.getPayload());
                BirdGps birdGps = stringBirdGps(string);
                birdGps.print();
                PostgreSQL db = new PostgreSQL(birdGps);
                db.connect();
            }

            //@Override
            public void deliveryComplete(IMqttDeliveryToken token) {//Called when a outgoing publish is complete
            } 
        });

        System.out.println("Time to connect");
        client.connect(MQTToptions);

        if (client.isConnected()) {
            System.out.println("Connected");

        } else {
            System.out.println("Connection failed");
        }

        client.subscribe("boaskaken1/devices/+/up", 2);


    }


    public void connectionLost(Throwable throwable) {

    }

    public void messageArrived(String s, MqttMessage mqttMessage) throws Exception {

    }

    public void deliveryComplete(IMqttDeliveryToken iMqttDeliveryToken) {

    }

    /*

    the original message

    {
    "app_id":"boaskaken1", [0]
    "dev_id":"my_first_lorawan_module", [1]
    "hardware_serial":"0004A30B001B5D78", [2]
    "port":1, [3]
    "counter":0, [4]
    "payload_raw":"EjRWeJCrze8=", [5]
    "payload_fields":
    {
        "LANG":"-1.2730366669860675e+29", [6]
        "LONG":"1.7378244361449504e+34"
    },  [7]
    "metadata":{
        "time":"2019-11-27T16:46:35.185851336Z"
    }
    } [8]


    after first stage of splitting

    dev_id":"my_first_lorawan_module"
    "payload_fields":{"LANG":"-1.2730366669860675e+29"
    "LONG":"1.7378244361449504e+34"}
    "metadata":{"time":"2019-11-27T18:00:24.785210782Z"}}

     */
    public static BirdGps stringBirdGps(String in){
        String[] parts = in.split(",");
        String devId = parts[1].substring(10).replace("\"", "");
        String Lang = parts[6].substring(26).replace("\"", "");
        String Long = parts[7].substring(8).replace("\"", "").replace("}", "");
        String time = parts[8].substring(20, 39).replace("\"", "").replace("}", "").replace("T", " ");

        BirdGps birdGps = toBirdGps(devId, Lang, Long, time);

        return birdGps;

    }

    public static BirdGps toBirdGps(String id, String lat, String lon, String time) {

        LocalDateTime date = null;

        double doubleLat = Double.valueOf(lat);
        double doubleLong = Double.valueOf(lon);

        try {

            date = LocalDateTime.parse(time);
        } catch (Exception e) {
            System.out.println(e.getMessage());
        } finally {
            if (date == null) {
                date = LocalDateTime.now();
            }

            BirdGps birdGps = new BirdGps(date, id, doubleLat, doubleLong);
            return birdGps;
        }

    }

}

