<template>
  <div class="container">
    <div class="heading"><h3>Dashboard</h3></div>
    <ul class="record_con">
      <li>
        <h4>Violators</h4>
        <p>30</p>
      </li>
      <li>
        <h4>Pending</h4>
        <p>30</p>
      </li>
      <li>
        <h4>Paid</h4>
        <p>30</p>
      </li>
    </ul>
  </div>
</template>

<script></script>

<style scoped>
.heading h3 {
  font-weight: bold;
}
.record_con {
  display: flex;
  width: 100%;
  justify-content: space-between;
  gap: 10px;
  border-radius: 20px;
  border: 1px solid #dee2e6 !important;
  padding: 20px;
}

.record_con li {
  border-radius: 20px;
  border: 1px solid #dee2e6 !important;
  min-height: 150px;
  width: 100%;
  max-width: 350px;
  position: relative;
}

.record_con li:first-child {
  background: #ffe2e6;
}
.record_con li:nth-child(2) {
  background: #fff4de;
}
.record_con li:last-child {
  background: #dcfce7;
}

.record_con li:first-child:after {
  position: absolute;
  content: '';
  background: url('../assets/images/violators-icon.png') no-repeat;
  top: 20px;
  right: -40px;
  width: 125px;
  height: 58px;
}

.record_con li:nth-child(2):after {
  position: absolute;
  content: '';
  background: url('../assets/images/pending-icon.png') no-repeat;
  top: 20px;
  right: -40px;
  width: 125px;
  height: 58px;
}

.record_con li:last-child:after {
  position: absolute;
  content: '';
  background: url('../assets/images/paid-icon.png') no-repeat;
  top: 20px;
  right: -40px;
  width: 125px;
  height: 58px;
}

.record_con li h4 {
  padding: 20px;
}

.record_con li p {
  padding: 0 20px 0;
  font-size: 40px;
  font-weight: bold;
}
</style>
