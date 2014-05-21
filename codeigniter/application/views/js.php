<!DOCTYPE html>

<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>JavaScript基礎</title>
</head>

<body>
    <script>
        document .write("hello");
        document .bgColor = "yellow";

        var year = 2000;
        document .write(year);

        //["文字列１", "文字列２", "文字列３"];//配列
        //{name: "チョコレート", type: "食品"};//連想配列

        alert("1行目\n2行目");//画面上にアラート表示
        
        document.write("\"Hello\"");//「"Hello"」を表示
        
        document.write("abc" + "de");//文字の連結

        document.write(123 + 456 + "abc");//123+456は演算になる
        document.write("abc" + 123 + 456);//数値の前に文字列があると数値も文字列扱い

        var number1;
        number1 = 3 + 5;
        document .write(number1);

        document .write(3 + 5);
        document .write("3 + 5");

        var calc = 10 + 5;
        document .write(calc);//15表示

        calc = calc + 5;
        document .write(calc);//20表示

        calc += 5;
        document .write(calc);//25表示

        document .write(calc ++);//25
        document .write(calc ++);//26
        document .write(calc ++);//27

        document .write(calc);//28

        document .write(++ calc);//29
        document .write(++ calc);//30
        document .write(++ calc);//31

        var heisei = 25;
        var seireki = 1988 + heisei;
        var message = "平成" + heisei + "年は西暦" + seireki + "年です。";
        document .write(message);

        var year = 2013;
        if (year === 2013) {
        document .write(year);
        } else {
        document .write("NO");
        }

        var i = 3;
        while (i < 100) {
        document .write(i);
        i += 5;
        }

        for (var i = 3; i < 100; i += 5) {
        document .write(i);
        }

        var elements = [10, 100, 1000];
        document .write(elements[2]);
        document .write(elements .length);//配列に格納されている要素の個数

        for (i = 0; i < elements .length; i++) {
        document .write(elements[i]);
        }

        
        var person = {
        "name": "Taro",
        "sex": "Male",
        "country": "Japan",
        "hobby": "programming"
        }
        document .write(person .hobby);

        var elem = "hobby";
        document .write(person[elem]);

        

        function hello() {
            document .bgColor = "aqua";//bgColorをaquaに
            //hello();//hello関数の呼び出し
            alert("実行されます");
            return "Hi!";
            alert("実行されません");
        }

        var returned_value = hello();
        document .write(returned_value);
        
        function keisan(x, y) {//xとyという引数を持っている
            return x + y * 5;
        }

        var calc_result = keisan(4, 6);
        document .write(calc_result);

        document .body .bgColor = "green";
        </script>

        <p id = "greeting">Change!!! Crick Here</p>
        <!--<script>//id=greetingのHelloをWorldにする
        document .getElementById("greeting") .innerHTML = "World";
        </script>-->

        <script>
            document .getElementById("greeting") .onclick = function() {
            document .getElementById("greeting") .innerHTML = "あは";
            }
        </script>


    </script>
</body>

</html>