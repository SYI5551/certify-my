<style>
  table 
      {
          counter-reset: section;
      }

  .count:before 
      {
          counter-increment: section;
          content: counter(section);
      }
</style>

<div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>No.</th>
        <th>Course Name</th>
        <th>Position</th>
        <th>Date</th>
        <th>Company Name</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="count"></td>
        <td><?php echo htmlentities($result->coursename);?></td>
        <td><?php echo htmlentities($result->position);?></td>
        <td><?php echo htmlentities($result->date);?></td>
        <td><?php echo htmlentities($result->companyname);?></td>
      </tr>
    </tbody>
  </table>
  </div>