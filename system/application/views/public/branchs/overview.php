<?= $this->load->view('_template/public_header.html'); ?>

  <script type="text/javascript">

      function editForm() {
        $('input').removeAttr("disabled");
        $('select').removeAttr("disabled");
        $('#editForm').css("display","none");
        $('#saveForm').css("display","block");
        
        $("#saveForm").click(function() {
          alert("Daten geändert.");
        }); 
      }  

      function removeItem(branch_id) {
        var bestaetigung = window.confirm('Wollen Sie die Branche wirklich löschen?');
        if(bestaetigung) {
          document.location.href = '<?=base_url();?>branch/remove/'+branch_id;
        }
      } 

            $(document).ready(function() { 

        $(".newWindow").fancybox({
          'scrolling'   : 'no',
          'titleShow'   : false
          });

        if ( $(".addButtonTop").length > 0 ) {
          $("#scroller").css("margin-top","43px");
        }

         //////////////typeahead///////
    var sourceArr;
    $.ajax({url:'<?=base_url();?>search/branch',success:function(result){
    document.getElementById("outside").value = result;
      
    sourceArr = document.getElementById("outside").value;
    var substringMatcher = function(js) {
      return function findMatches(q, cb) {
        var matches, substringRegex;
        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        
        $.each(js, function(i, str) {
          if (substrRegex.test(str.name)) {
            // the typeahead jQuery plugin expects suggestions to a
            // JavaScript object, refer to typeahead docs for more info
            matches.push({ value: str.name, id: str.id});
          }
        });
        cb(matches);
      };
};

$('#the-basics .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},

{
  name: 'products',
  displayKey: 'value',
  source: substringMatcher($.parseJSON(sourceArr)),
   /*templates: {
      empty: [
      '<div class="empty-message">',
      'unable to find any Best Picture winners that match the current query',
      '</div>'
      ].join('\n'),
      suggestion: Handlebars.compile('<p><strong>{{value}}</strong> – {{id}}</p>')
      }
    */  
  // alert(JSON.stringify(obj)); // object
  // outputs, e.g., {"type":"typeahead:selected","timeStamp":1371822938628,"jQuery19105037956037711017":true,"isTrigger":true,"namespace":"","namespace_re":null,"target":{"jQuery19105037956037711017":46},"delegateTarget":{"jQuery19105037956037711017":46},"currentTarget":
  //alert(JSON.stringify(datum)); // contains datum value, tokens and custom fields
  // outputs, e.g., {"redirect_url":"http://localhost/test/topic/test_topic","image_url":"http://localhost/test/upload/images/t_FWnYhhqd.jpg","description":"A test description","value":"A test value","tokens":["A","test","value"]}
  // in this case I created custom fields called 'redirect_url', 'image_url', 'description'   

  //alert(JSON.stringify(name)); // contains dataset name
  // outputs, e.g., "my_dataset"

}).bind('typeahead:selected', function(obj, datum,name) {
        //selectd element typeahead
       // alert("Selected: "+datum.id + "name " + datum.value );
        document.location.href = '<?=base_url();?>branch/show/' + datum.id;

    });
    }});//$.ajax
      }); 
  </script>
</head>

<body>
  
  <div id="wrapper">
   <div id="greyTop">
    <div id="innerWrapper">
    <div id="leftBox">
      <?$this->load->view('public/navigation',$navstate);?>

 <div id="the-basics">
      <input type="hidden" id="outside" value="">
      <input class="typeahead" type="text" placeholder="Branche finden...">
      </div>
      
      <div id="scroller" class="scrollerNav">
         <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
      <div class="addButtonTop"><a class="newWindow" href="<?=base_url();?>branch/showAdd"><span class="greenFont">+</span> Branche hinzufügen</div></a>
      <?php endif; ?>
        
        
           <ul id="navLeft">
          <?php foreach ($nav as $name) :?>
            <li onclick="document.location.href = '<?=base_url();?>branch/show/<?= $name->id; ?>'"><p><?= $name->name; ?></p><span class="navArrow"></span>
            <div class="clear"></div></li>
          <?php endforeach; ?>
        </ul>
        
      </div>
    </div>
    
    <div id="rightBox">
      <div id="headTop">
        <h1>Branchen</h1>
        <div class="logout"><a href="<?=base_url();?>login/logout">&raquo; Logout</a></div>
        <div class="clear"></div>
      </div>

      <div id="content">
        <div class="grey">
        <h1><? if(isset($formular->name)) { echo $formular->name; } ?></h1>
        
        <div id="left">
          <form class="data" action="<?=base_url();?>branch/save/<? if(isset($formular->id)) { echo $formular->id; } ?>" method="post">
            
            <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
            <div style="float:left; cursor:pointer; margin-bottom:20px;" id="editForm" onclick="editForm()">&raquo; Editieren</div>
            <input type="submit" value="Speichern" name="save" id="saveForm" />
            <div class="clear"></div>
            <?php endif;?>
            <label class="user" for="branchname">Branchenname:</label>
            <input type="text" id="branchname" name="branchname" disabled="disabled" value="<? if(isset($formular->name)) { echo $formular->name; } ?>">
            <div class="clear"></div> 
                        
          </form>

          <?php if ($this->session->userdata('role') == "admin"): ?>
          <div class="greyBox" onclick="removeItem('<? if(isset($formular->id)) { echo $formular->id; } ?>')">
           <img src="<?=base_url();?>css/images/deleteIcon.png" alt="Löschen" /><p>Branche löschen</p>
           <div class="clear"></div>
          </div>
          <?php endif;?>
        </div>

        <div class="clear"></div>

      </div>
      
    </div>
     </div>
    <div class="clear"></div>
    </div>
    
    </div>
  </div>
  
</body>
</html>