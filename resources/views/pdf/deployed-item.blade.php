<!DOCTYPE HTML>

<html>
    <head>
        <style type="text/css">
            .bodyBody {
                margin: 40px;
                font-size: 1em;
            }
            .divHeader {
                text-align: right;
                border: 1px solid;
            }
            .LogoGoesHere{
                text-align: center;
                align-items: center;
            }
            .divReturnAddress {
                text-align: left;
                float: right;
            }
            .divSubject {
                clear: both;
                font-weight: bold;
                text-align: center;
                align-items: center;
                padding-top: 30px;
            }
            .divAdios {
                float: right;
                padding-top: 50px;
            }
            .page-break {
                    page-break-before: always;
                }
        </style>
    </head>
    <body class="bodyBody">

    <div class="LogoGoesHere">
    <img src="<?php echo $image ?>" width="450px" height="120px" alt="image">


        </div>

        <div class="divReturnAddress">
        <br/>
        <br/>

        <p> {{ $currentDate }}</p><br/>
            
        </div>

        <div class="divSubject">
            Request Form
        </div>

        <div class="divContents">
            <br/>
            <br/>
            <p>
                Auto Generated Receiving Form.
            </p>

            <p>
                Auto Generated Receiving Form. Auto Generated Receiving Form.
                Auto Generated Receiving Form. Auto Generated Receiving Form.
                Auto Generated Receiving Form. Auto Generated Receiving Form.
            </p>

            <br/>
            <br/>

            <p>Received By: {{ $deployeds->requested_by }}</p>
            <p> Deployed By: {{ $deployeds->deployed_by }}</p>
            <p>Item Details: {{ $deployeds->item_requested }}</p>
            

        </div>

        <div class="divAdios">
            <!-- Space for signature. -->
            <br/>
            <br/>
            <br/>
            Sir Julius <br/>
            IT Head <br/>
        </div>
        


    </body>
</html>