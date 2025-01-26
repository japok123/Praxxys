<template>
    <v-main>
      <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>
                        <p>Bounce Rate</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                    <div class="inner">
                        <h3>150</h3>
                        <p>New Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>
                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>
                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
            </div>
          <div class="row">
            <!-- Sales Card -->
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Sales
                  </h3>
                </div>
                <div class="card-body">
                  <!-- Chart Canvas -->
                  <canvas id="revenue-chart-canvas" height="250"></canvas>
                </div>
              </div>
            </div>
  
            <!-- Visitors Card -->
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-chart-bar mr-1"></i>
                    Visitors
                  </h3>
                </div>
                <div class="card-body">
                  <!-- Chart Canvas -->
                  <canvas id="visitors-chart-canvas" height="250"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </v-main>
  </template>
  
  <script>
    import { onMounted } from 'vue';
  import Chart from 'chart.js/auto';
  
  export default {
    name: "Dashboard",
    setup() {
      onMounted(() => {
        // Initialize Revenue Chart
        const revenueCtx = document.getElementById("revenue-chart-canvas").getContext("2d");
        new Chart(revenueCtx, {
          type: "line",
          data: {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
              {
                label: "Sales",
                data: [65, 59, 80, 81, 56, 55, 40],
                borderColor: "rgba(60,141,188,0.8)",
                backgroundColor: "rgba(60,141,188,0.3)",
              },
            ],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false, // Allow custom sizing
            plugins: {
              legend: {
                display: true,
              },
            },
          },
        });
  
        // Initialize Visitors Chart
        const visitorsCtx = document.getElementById("visitors-chart-canvas").getContext("2d");
        new Chart(visitorsCtx, {
          type: "bar",
          data: {
            labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
            datasets: [
              {
                label: "Visitors",
                data: [28, 48, 40, 19, 86, 27, 90],
                backgroundColor: "rgba(255,99,132,0.8)",
              },
            ],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false, // Allow custom sizing
            plugins: {
              legend: {
                display: true,
              },
            },
          },
        });
      });
    },
  };
  </script>
  
  <style scoped>
  .content {
    padding: 20px;
  }
  
  .card-body {
    padding: 20px;
  }
  
  canvas {
    width: 100% !important; /* Make canvas fit the card */
    height: 250px !important; /* Set height to a specific value */
  }
  </style>
  