$(document).ready(function() {
    var dataSet1 = [{
        id: 1,
        gender: "M",
        first: "John",
        last: "Smith",
        city: "Seattle",
        state: "WA",
        status: "Active"
      },
      {
        id: 2,
        gender: "F",
        first: "Kelly",
        last: "Ruth",
        city: "Dallas",
        state: "TX",
        status: "Active"
      },
      {
        id: 3,
        gender: "M",
        first: "Jeff",
        last: "Stevenson",
        city: "Washington",
        state: "D.C.",
        status: "Active"
      },
      {
        id: 4,
        gender: "F",
        first: "Jennifer",
        last: "Gill",
        city: "Boston",
        state: "MA",
        status: "Inctive"
      }
    ];
  
    var table = $("#example").DataTable({
      data: dataSet1,
      dom: "Bfrtip",
      buttons: [{
        extend: "pdfHtml5",
        customize: function(doc) {
          //var iColumns = $('#tableau').length;
          var iColumns = 6;
          //var rowCount = document.getElementById("example").rows.length; 
          var rowCount = 5;
          for (i = 0; i < rowCount; i++) { 
                  doc.content[1].table.body[i][iColumns - 1].alignment = 'center';
                  doc.content[1].table.body[i][iColumns - 2].alignment = 'center';                
                };
          //doc.styles.tableBodyEven.alignment = 'center';
          //doc.styles.tableBodyOdd.alignment = 'center'; 
        },      
        exportOptions: {
          orthogonal: "myExport"
        }
      }],
      columns: [{
          data: "id"
        },
        {
          data: "gender"
        },
        {
          data: "first"
        },
        {
          data: "last"
        },
        {
          data: "city"
        },
        {
          data: "status",
          render: function(data, type, row) {
            if (type === 'myExport') {
              return data === 'Active' ? "Y" : "N";
            }
            if (data === 'Active') {
              return '<input type="checkbox" class="editor-active" onclick="return false;" checked>';
            } else {
              return '<input type="checkbox" onclick="return false;" class="editor-active">';
            }
            return data;
          },
          className: "dt-body-center text-center"
        }
      ]
    });
  });
