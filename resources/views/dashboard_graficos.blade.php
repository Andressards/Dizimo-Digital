<div>
nav
  header Sales Report
  section
    header Main
    ul
      li.active Dashboard
      li(data-value="8") Reports
      li Groups

  section
    header Account
    ul
      li Activity
      li(data-value="4") Messages
      li Downloads

  section
    header Categories
    ul
      li.red Credit Sales
      li.yellow Channel Sales
      li.green Direct Sales
      li.new 
        i.fa.fa-plus-circle 
        |  Add Category

article
  header
    .title Dashboard
    .user
    .interval
      ul
        li Weekly
        li.active Monthly
        
  section
    .chart
      canvas#c1(width=900, height=200)
    
  section
    header Total Sales
    .inlineChart
      canvas#c2(width=100, height=100)
      .info
        .value $36,146
        .title Credit sales
    .inlineChart
      canvas#c3(width=100, height=100)
      .info
        .value $24,734
        .title Channel Sales
    
    .inlineChart
      canvas#c4(width=100, height=100)
      .info
        .value $15,650
        .title Direct Sales
  
  section
    table
      thead
        tr
          th November Sales
          th Quantity
          th Total
      tbody
        tr
          td Dallas Oak Dining Chair
          td 20
          td $1,342
        tr
          td Benmore Glass Coffee Table
          td 18
          td $1,550
        tr
          td Aoraki Leather Sofa
          td 15
          td $4,170
        tr
          td Bali Outdoor Wicker Chair
          td 25
          td $2,974
    
    
</div>