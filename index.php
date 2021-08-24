<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/reset-css@5.0.1/reset.min.css" />
  
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="./css/common.css" />
  <link rel="stylesheet" href="./css/main.css" />
  <script defer src="https://cdn.datatables.net/t/bs-3.3.6/jqc-1.12.0,dt-1.10.11/datatables.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js" integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js" integrity="sha512-UxP+UhJaGRWuMG2YC6LPWYpFQnsSgnor0VUF3BHdD83PS/pOpN+FYbZmrYN+ISX8jnvgVUciqP/fILOXDjZSwg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/ScrollToPlugin.min.js" integrity="sha512-1OG9UO4krPizjtz/c9iDbjCqtXznBYdJeD4ccPaYfJHzC6F1qoQ3P1bgQ3J8lgCoK5qGVCqsY4+/RKjLDzITVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
  <script defer src="./js/main.js" type="text/javascript" ></script>
  <title>CCTV 현장번호</title>
  <?php
    $conn = mysql_connect("127.0.0.1", "root", "!@#dsa1");
    mysql_select_db("gpspush", $conn);

    
    $content = addslashes($_POST['content']); 

    $content = iconv("utf-8", "euc-kr", $content);
    $title = addslashes($_GET['title']);
    //$title  = iconv("utf-8", "euc-kr", $title );
    $content_value = addslashes($_GET['content_value']);
  ?>
</head>

<body>

  <!-- HEADER -->
  <header >
    <div class="inner">
      <div class="header-main">
        <div class="sub-main">
          <input type="search" class="ser" id="serachInput" placeholder="검색어를 입력하세요">
          <a href="javascript:void(0)" class="btn btn--default">검 색</a>
        </div>
        <div class="but-group">
          <a href="javascript:void(0)" class="btn btn--w">CCTV 수정</a>
          <a href="javascript:void(0)" class="btn btn--w">CCTV 추가</a>
          <a href="javascript:void(0)" class="btn btn--w">사용안함</a>
        </div> 
        <div class="combo">
          <select style="height: 40;" id ="content_value" name ="content_value1" class="selectbox">
            <option value='' >모듈선택</option>
            <?php
              $sql="select eqcd from cctv_num where title='".$title."' and isService ='1' group by eqcd";

              $result = mysql_query($sql);
              
              while($row = mysql_fetch_array($result)) {
                if($row['eqcd'] == $content_value){
              ?>
                  <option value='<?=$row['eqcd']?>' selected><?=$row['eqcd']?></option>
                <?}else{?>
                  <option value='<?=$row['eqcd']?>' ><?=$row['eqcd']?></option>
                <?}?>
              <?}?>
          </select>
        </div>
        <div class="txtgroup">
          <span style="color: red;font-size:13px; font-weight: bold ;">* 사용하지 않는 CCTV 명칭은 체크 후 CCTV 수정</span>
          </br>
          <span style="color: blue;font-size:13px; font-weight: bold ;">* <ins>사용하지 않는 CCTV는 GPSLIST에 보여지지 않습니다.</ins></span>
        </div>
      </div>
    </div>
  </header>

  <!-- 테이블 메인 -->
  <section class="main">
    <div class="inner">
      <div class="table">
        <table class="table table-bordered table-bordered" id="ttable">
          <!-- 테이블 헤더-->
          <thead>
            <tr class="thead">
              <th width="18%" scope="col" >순번</th>
              <th width="59%" scope="col">CCTV 이름</th>
              <th width="13%" scope="col">eqcd</th>
              <th width="10%" scope="col"></th>
            </tr>
          </thead>

          <!--테이블 본문-->
          <tbody class="tcen">
            <?php
              //$sql="select cctvname,cctvid,eqcd,isService from gpspush.cctv_num  where title='전주' limit 50";
              $sql="select cctvname,cctvid,eqcd,isService from gpspush.cctv_num where title='".$title."' and eqcd='".$content_value."' and isService='1' order by ABS(cctvid)";
              $result = mysql_query($sql);
              $getNumArr;
              $getNumArr=explode(";", $content);

              while($row = mysql_fetch_array($result)) {			
            ?>          
            <tr class="tbody">
              <th data-sort='<?=$row['cctvid']?>'>
                <input type="number" pattern="09[0-9]{9}" class="b_box1_1" id='content'  onfocus="select()" data='<?=$row['cctvid']?>' value="<?=sprintf('%02d',$row['cctvid'])?>" >
              </th>
              <th><?=$row['cctvname']?></th>
              <th><?=preg_replace("/[^0-9]*/s", "", $row['eqcd']);?></th>
              <th class="chk">
                <?if($row['isService']=="0"){?>
                  <input type='checkbox' class="ischeck" name='isService' id='isService' value='0' checked/>
                <?}else{?>
                  <input type='checkbox' class="ischeck" name='isService' id='isService' value='0' />
                <?}?>
              </th>
            </tr>
           <?}?>
          </tbody>

        </table>
      </div>
    </div>
  </section>

  <div id="to-top">
    <div class="material-icons">arrow_upward</div>
  </div>

</body>
</html>