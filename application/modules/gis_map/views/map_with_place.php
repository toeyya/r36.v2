Listing 2 การ mark สถานที่หลายจุดด้วยรูปภาพโดยการสร้าง user-defined div ที่มีูรูปภาพอยู่ภายใน

<html>
    <head>
        <title>Mutiple user-defined div</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        
        <style type="text/css">
            /*style สำหรับจัดรูปแบบของแผนที่*/
            #mmMapDiv{
                position:absolute;
                left:0px;
                top:0px;
            }
        </style>
        <script
            type="text/javascript"
            src="http://mmmap15.longdo.com/mmmap/mmmap.php?key=18b1fbbda1f980b4e368c631a3d317ea">
        </script>
        <script type="text/javascript">

            //ตัวแปรเพื่อใช้อ้างอิงไปยัง map object
            var mmmap;

            //function initialize สำหรับสร้าง map object
            function initialize(){
                var mmMapDiv = document.getElementById("mmMapDiv");
                mmmap = new MMMap(mmMapDiv, 13.81998, 100.60558, 8, "traffic");

                //ปรับขนาดของแผนที่ให้กว้าง 600 px และสูง 600 px ด้วย method setSize ของ map object
                mmmap.setSize(600,600);
                //เปลี่ยนจุดศูนย์กลางของแผนที่มายังจุดเริ่มต้น
                mmmap.moveTo(13.83095, 100.60833);
                //ปรับระดับการ zoom ของแผนที่เป็นค่าเริ่มต้น
                mmmap.setZoom(8);
                //ทำการแสดงผลแผนที่ใหม่ เพื่อปรับปรุงการแสดงผลของแผนที่ให้ถูกต้อง
                mmmap.rePaint();

                //สร้าง user-defined div แบบแสดงข้อความแหน่งบ้านของ Mr A และเก็บค่า id ของ user-defined div ไว้ในตัวแปร userDivIdA
                var userDivIdA = createUserDivImage(13.83816, 100.54213,
                "themes/map/media/images/hospital.png",
                "Mr A's house, number 48");

                //สร้าง user-defined div แบบแสดงรูปภาพตำแหน่งบ้านของ Ms B
                //และเก็บค่า id ของ user-defined div ไว้ในตัวแปร userDivIdB
                var userDivIdB = createUserDivImage(13.86937, 100.65601,
                "themes/map/media/images/hospital.png",
                "Ms B's house, number 60");
   
                //สร้าง user-defined div แบบแสดงรูปภาพตำแหน่งบ้านของ Mr C
                //และเก็บค่า id ของ user-defined div ไว้ในตัวแปร userDivIdC
                var userDivIdC = createUserDivImage(13.7699, 100.6145,
                "themes/map/media/images/hospital.png",
                "Mr C's house, number 99");
            }

            //function createUserDivImage เพื่อสร้าง user-defined div ที่มีรูปภาพอยู่ภายใน
            function createUserDivImage(latitude, longitude, imageURL, description){
                //สร้าง div element
                var divElement = document.createElement("div");
                //สร้าง img element
                var imgElement = document.createElement("img");
                imgElement.setAttribute("src", imageURL);
                divElement.appendChild(imgElement);
                // **** เรียกใช้ method drawCustomDiv ของ map object (mmmap) เพื่อวาด user-defined div ลงบนแผนที่
                //และเก็บค่า id ของ user-defined div ไว้ในตัวแปร userDivId
                var userDivId = mmmap.drawCustomDiv(divElement,latitude, longitude,description);
                return userDivId;
            }
        </script>

    </head>
    <body onload="initialize()">
        <div id="mmMapDiv"></div>
    </body>
</html>