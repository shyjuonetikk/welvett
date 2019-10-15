 $message = "<html><head>
			<style>
				h2 {
					background-color:$themeColor;
					color:$fontColor;
					text-align:center;
				}
				table {
					border:1px solid $themeColor;
                                        background-color: #f8f8f8; 
				}
				tr , td , th{
					border:1px solid $themeColor;
				}
                                .subject {
                                background-color: $primaryColor;
                                padding:10px 5px;
                                }
                                h3 {
                                color: $subjectColor;
                                text-align:center;
                                }
                                img {
                                display:block;
                                margin:auto;
                                width:300px;
                                }
			</style>	
			</head><body>
                        <div class='subject'>
                        <img src='http://" . $_SERVER['SERVER_NAME'] . '/' . $this->request->webroot."img/logo.png' width='300'/>
                        </div>
			<table cellpadding='10' align='center' width='100%' cellspacing='0'>
				<tr>
					<th>Full Name</th>
					<td>" . ucwords($this->request->data['fname']) . ' ' . ucwords($this->request->data['lname']) . "</td>	
				</tr>
				<tr>
					<th>Email</th>
					<td>" . $this->request->data['email'] . "</td>	
				</tr>
                                <tr>
					<th>Phone</th>
					<td>" . $this->request->data['phone'] . "</td>	
				</tr>
                                
				<tr>
					<th>Message</th>
					<td>" . $this->request->data['message'] . "</td>	
				</tr>
			</table>
