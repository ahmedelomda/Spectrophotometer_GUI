<!DOCTYPE HTML><html>
    <head>
        <title>Web page App</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="style.css?v=<?php echo time(); ?>">        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <p class="name" style="color: #fd0000;">Discrete Scan</p>
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
                            <input type="text" name="WL1" placeholder="WL1" required> <br>
                            <input type="text" name="WL2" placeholder="WL2" required> <br>
                            <input type="text"  name="WL3" placeholder="WL3" required> <br>
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

                <div style="border-bottom: 2px solid #333;">
                    <table id="table1" style="margin-top: 2rem; margin-bottom: 3rem">
                        <tr>
                            <th>WL1(nm)</th>
                            <th>WL2(nm)</th>
                            <th>WL3(nm)</th>
                            <th>A1(Au)</th>
                            <th>A2(Au)</th>
                            <th>A3(Au)</th>
                            <th>C1(g/L)</th>
                            <th>C2(g/L)</th>
                            <th>C3(g/L)</th>
                        </tr>
                        
                        <?php 
                            include ('table1.php');
                        ?>
                    </table>
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

            function alert_for_run()
            {

            }

            function show_WL()
            {
                document.querySelector('#table1').insertAdjacentHTML(
                    'afterbegin',
                    `<tr>
                        <th>WL1</th>
                        <th>WL2</th>
                        <th>WL3</th>
                        <th>A1</th>
                        <th>A2</th>
                        <th>A3</th>
                    </tr>
                    <?php 
                        include ('table1.php');
                    ?>
                    `
                )
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
                        <th>WL1</th>
                        <th>WL2</th>
                        <th>WL3</th>
                        <th>Equation</th>
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
                        <th>WL1</th>
                        <th>WL2</th>
                        <th>WL3</th>
                        <th>Equation</th>
                    </tr>   
                    <?php 
                        include ('home.php');
                    ?>`
                )
            }

            <?php 
                include ('chart.php');
            ?>

            var A1 = '<?=$l_row['A1']?>';
            var C1 = '<?=$l_row['C1']?>';
            var A2 = '<?=$l_row['A2']?>';
            var C2 = '<?=$l_row['C2']?>';
            var A3 = '<?=$l_row['A3']?>';
            var C3 = '<?=$l_row['C3']?>';

            var A11 = '<?=$sl_row['A1']?>';
            var C11 = '<?=$sl_row['C1']?>';
            var A22 = '<?=$sl_row['A2']?>';
            var C22 = '<?=$sl_row['C2']?>';
            var A33 = '<?=$sl_row['A3']?>';
            var C33 = '<?=$sl_row['C3']?>';

            var A111 = '<?=$tl_row['A1']?>';
            var C111 = '<?=$tl_row['C1']?>';
            var A222 = '<?=$tl_row['A2']?>';
            var C222 = '<?=$tl_row['C2']?>';
            var A333 = '<?=$tl_row['A3']?>';
            var C333 = '<?=$tl_row['C3']?>';
            // fetch('chart.php')
            //     .then(response => response.json())
            //     .then(data => {
            //         console.log(data)

            //     }).catch((error) => {
            //         console.error('Error:', error);
            //     });
            var xyValues1 = [
                {x:C1, y:A1},
                {x:C2, y:A2},
                {x:C3, y:A3},
            ];
            var xyValues2 = [
                {x:C11, y:A11},
                {x:C22, y:A22},
                {x:C33, y:A33},
                
            ];
            var xyValues3 = [
                {x:C111, y:A111},
                {x:C222, y:A222},
                {x:C333, y:A333},
                
            ];

            new Chart("myChart", {
                type: "scatter",
                data: {
                    datasets: [
                        {
                        pointRadius: 6,
                        pointBackgroundColor: "rgb(0,0,255)",
                        data: xyValues1,
                        },
                        {
                        pointRadius: 6,
                        pointBackgroundColor: "rgb(255,0,0)",
                        data: xyValues2
                        },
                        {
                        pointRadius: 6,
                        pointBackgroundColor: "rgb(0,255,0)",
                        data: xyValues3
                        }   
                    ]
                },
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: ' Absorbance VS Concentration',
                        fontSize: 20,
                    },
                    scales: {
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Absorbance',
                                font: {
                                    size: 18,
                                }
                            }
                        }],
                        xAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Concentration'
                            }
                        }],
                    }
                }
            });
            

        </script>
    </body>
</html>

