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

        System.out.println("time to connect");
        client.connect(MQTToptions);

        if (client.isConnected()) {
            System.out.println("Connected");

        } else {
            System.out.println("Connection failed");
        }

        client.subscribe("boaskaken1/devices/+/up", 1);


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

    // optional
    "is_retry":true,

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
    public static BirdGps stringBirdGps(String in) {

        //debug time
        /*
        in = "{\"app_id\":\"boaskaken1\"," +
                "\"dev_id\":\"boaskalma2\"," +
                "\"hardware_serial\":\"0004A30B001AF7DC\"," +
                "\"port\":1," +
                "\"counter\":0," +
                //"\"is_retry\":true," + //uncoment for testing if the firs mesage is receved correctly
                "\"payload_raw\":\"F/BgQmvEukE=\"," +
                "\"payload_fields\":{\"LAT\":\"23.345907\"," +
                "\"LONG\":\"56.234463}," +
                "\"metadata\":{" +
                "\"time\":\"2020-01-29T06:30:15.671275718Z\"," +
                "\"frequency\":867.9," +
                "\"modulation\":\"LORA\"," +
                "\"data_rate\":\"SF7BW125\"," +
                "\"airtime\":56576000," +
                "\"coding_rate\":\"4/5\"," +
                "\"gateways\":[{" +
                "\"gtw_id\":\"nesscis_weenapoint\"," +
                "\"gtw_trusted\":true," +
                "\"timestamp\":3690607516," +
                "\"time\":\"2020-01-29T06:30:09Z\"," +
                "\"channel\":7," +
                "\"rssi\":-97," +
                "\"snr\":8.75," +
                "\"rf_chain\":0," +
                "\"latitude\":51.926147," +
                "\"longitude\":4.484228," +
                "\"location_source\":\"registry\"}]}}";
                */


        String[] parts = in.split(",");
        String[] devIdParts = parts[1].split("\"");

        String[] langParts;
        String[] longParts;
        String[] timeParts;

        if (parts[5].split("\"")[1].equals("is_retry")) {
            System.out.println("retry");
            langParts = parts[6 + 1].split("\"");
            longParts = parts[7 + 1].split("\"");
            timeParts = parts[8 + 1].split("\"");
        } else {
            langParts = parts[6].split("\"");
            longParts = parts[7].split("\"");
            timeParts = parts[8].split("\"");
        }

        String devId = devIdParts[3];

        String Lang = langParts[5].substring(0, 6);
        System.out.println("lang " + Lang);
        String Long = longParts[3].replace("}", "").substring(0, 6);
        System.out.println("long " + Long);
        String time = timeParts[5].substring(0, 19);
        System.out.println("time " + time);

        BirdGps birdGps = toBirdGps(devId, Lang, Long, time);

        //birdGps.print();

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

