<!DOCTYPE HTML><html>
    <head>
        <title>Web page App</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
        </script>

    </head>

    <body>
        <div class="header">
            <div class="container">
                <nav class="nav-header">
                    <div>
                        <a href="#"><i class="fa fa-gear" style="font-size:24px;"></i></a>
                    </div>
                    <div>
                        <a href="#">
                            <i class="fa fa-user-circle-o" style="font-size:26px"></i>
                            Ahmed Omda
                        </a>
                    </div>
                    <div class="light">
                        <a href="#">&#955; : </a>
                        <a id="lamp" onclick="light_On_Off()"><i class="fa fa-lightbulb-o" style="font-size:30px"></i></a>
                    </div> 
                </nav>
            </div>
        </div>

        <div class="container-body">
            <div class="side-bar">
                <p class="name" style="color: #fd0000;">Wavelength Scan</p>
                <div class="methods">
                    <p style="font-size:20px;">List Of Methods :</p>
                    <a onclick="FE_In_Water()" style="cursor:pointer">FE in Water</a>
                    <a onclick="Lead_analysis()" style="cursor:pointer">Lead Analysis</a>
                </div>
            </div>

            <div class="section-body">
                <div class="instructions">
                    <a href="../home page/">
                        <button class="btn" style="background-color: #f4511e;"><i class="fa fa-home"></i>Home</button>
                    </a>
                    <a>
                        <button class="btn" style="background-color: royalblue;"><i class="fa fa-plus"></i> New</button>
                    </a>
                    <a href="#">
                        <button class="btn" style="background-color: green;"><i class="fa fa-save"></i> Save</button>
                    </a>
                    <button class="btn" style="background-color: greenyellow;"><i class="fa fa-pencil"></i>SaveAs</button>
                    <button class="btn" style="background-color: red;"><i class="fa fa-trash"></i> Delete</button>
                </div>

                <div class="parameter">
                    <h3 style="text-decoration: underline;">>> Method Parameter</h3>
                    <div class="form">
                        <form method="post" action="form.php">
                            <input type="text" name="Start_WL" placeholder="Start_WL" required> <br>
                            <input type="text" name="End_WL" placeholder="End_WL" required> <br>
                            <!-- <input type="text"  name="WL3" placeholder="WL3" required> <br> -->
                            <br>
                            <a >
                                <button class="btn2" type="submit" name="submit"  style="background-color: royalblue;">Run</button>
                            </a>

                            <a>
                                <button class="btn2" style="background-color: royalblue;">Pause</button>
                            </a>    
                            <a>
                                <button class="btn2" style="background-color: royalblue;">Stop</button>
                            </a>  
                        </form>
                    </div>                    
                </div>

                <div class="sample" id="sample1" >
                    <!-- name of sample -->
                </div>
                
                <div>
                    <table id="content" style="margin-bottom: 7rem">
                    </table>
                </div>

                <canvas id="myChart" style="width:100%; height:450; max-width:800px; margin-bottom: 6rem"></canvas>

            </div>
            
        </div>
        
        <div class="footer">
            <nav class="nav-footer">
                <div>
                    <p>Date/Time : </p>
                    <p>Current Status : </p>
                </div>
                <div>
                    <P>Active Method</P>
                </div>
                <div>
                    <p>Serial Number : </p>
                    <p>Model(Name)</p>
                </div> 
            </nav>
        </div>

        <script>    
        
            function light_On_Off()
            {
                var lamp = document.getElementById("lamp");
                if(lamp.style.color != "yellow")
                {
                    lamp.style.color = 'yellow';
                } else {
                    lamp.style.color = 'white';
                } 
            }

            function FE_In_Water()
            {
                document.querySelector('#sample1').insertAdjacentHTML(
                    'afterbegin',
                    `<p class="sample-name">>> FE in Water</p>`
                )

                document.querySelector('#content').insertAdjacentHTML(
                    'afterbegin',
                    `<tr>
                        <th>Sample Name</th>
                        <th>Description</th>
                    </tr>   
                    <?php 
                        include ('home.php');
                    ?>`
                )
            }

            function Lead_analysis()
            {   
                document.querySelector('#sample1').insertAdjacentHTML(
                    'afterbegin',
                    `<p class="sample-name">>> Lead Analysis</p>`
                )

                document.querySelector('#content').insertAdjacentHTML(
                    'afterbegin',
                    `<tr>
                        <th>Sample Name</th>
                        <th>Description</th>
                    </tr>   
                    <?php 
                        include ('home.php');
                    ?>`
                )
            }

            var xValues = [250,300,350,400,450,500,550,600,650,700];

            new Chart("myChart", {
                type: "line",
                data: {
                    labels: xValues,
                    datasets: [
                        { 
                            data: [0.1,0.2,0.3,0.04,0.8,0.9,0.06,0.09,0.5,0.6,0.7,0.2,0.3,0.8,0.9,0.2,0.3,0.04],
                            borderColor: "red",
                            fill: false
                        }, 

                    ]
                },
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: ' Absorbance (Au) VS Wavelength (nm)',
                        fontSize: 20,
                    },
                    scales: {
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Absorbance (Au)',
                                font: {
                                    size: 18,
                                }
                            }
                        }],
                        xAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Wavelength (nm)'
                            }
                        }],
                    }
                }
            });
            
        </script>
    </body>
</html>

