 <!-- Company Dashboard Section -->
 <section id="company-dashboard" class="my-5">
    <div class="container">
      <h2 class="text-center">Company Dashboard</h2>
      <div class="row">
        <!-- Post Job Form -->
        <div class="col-md-6">
          <h4>Post a Job</h4>
          <form method="POST" action="post_job.php">
            <div class="mb-3">
              <label for="jobTitle" class="form-label">Job Title</label>
              <input type="text" class="form-control" id="jobTitle" name="job_title" required>
            </div>
            <div class="mb-3">
              <label for="jobDescription" class="form-label">Job Description</label>
              <textarea class="form-control" id="jobDescription" name="job_description" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Post Job</button>
          </form>
        </div>

        <!-- View Applications -->
        <div class="col-md-6">
          <h4>View Applications</h4>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Student Name</th>
                <th>Job Title</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- Example row -->
              <tr>
                <td>John Doe</td>
                <td>Software Engineer</td>
                <td>Applied</td>
                <td>
                  <a href="accept.php?app_id=1" class="btn btn-success btn-sm">Accept</a>
                  <a href="reject.php?app_id=1" class="btn btn-danger btn-sm">Reject</a>
                </td>
              </tr>
              <!-- Loop through applications here -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>