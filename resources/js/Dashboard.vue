<template>
  <div>
    <h3>Abonnement Data</h3>
    <pie-chart :chart-data="abonnementChartData"></pie-chart>

    <h3>Monthly Inscriptions</h3>
    <line-chart :chart-data="monthlyChartData"></line-chart>

    <h3>Active vs Expired Inscriptions</h3>
    <bar-chart :chart-data="statusChartData"></bar-chart>

    <h3>Versements vs Inscriptions Difference</h3>
    <bar-chart :chart-data="differenceChartData"></bar-chart>
  </div>
</template>

<script>
import { Pie, Line, Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, ArcElement, LineElement, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, ArcElement, LineElement, BarElement, CategoryScale, LinearScale)

export default {
  components: {
    PieChart: {
      extends: Pie,
      props: ['chartData'],
      mounted() {
        this.renderChart(this.chartData, { responsive: true, maintainAspectRatio: false })
      }
    },
    LineChart: {
      extends: Line,
      props: ['chartData'],
      mounted() {
        this.renderChart(this.chartData, { responsive: true, maintainAspectRatio: false })
      }
    },
    BarChart: {
      extends: Bar,
      props: ['chartData'],
      mounted() {
        this.renderChart(this.chartData, { responsive: true, maintainAspectRatio: false })
      }
    }
  },
  props: {
    abonnementData: Array,
    monthlyData: Array,
    statusData: Array,
    differenceData: Array
  },
  computed: {
    abonnementChartData() {
      return {
        labels: this.abonnementData.map(item => item.abonnement),
        datasets: [{
          label: 'Total',
          data: this.abonnementData.map(item => item.total),
          backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
        }]
      }
    },
    monthlyChartData() {
      return {
        labels: this.monthlyData.map(item => `${item.month}/${item.year}`),
        datasets: [{
          label: 'Inscriptions',
          data: this.monthlyData.map(item => item.total),
          backgroundColor: '#36A2EB'
        }]
      }
    },
    statusChartData() {
      return {
        labels: this.statusData.map(item => `${item.month}/${item.year}`),
        datasets: [
          {
            label: 'Active',
            data: this.statusData.map(item => item.active),
            backgroundColor: '#4BC0C0'
          },
          {
            label: 'Expired',
            data: this.statusData.map(item => item.expired),
            backgroundColor: '#FF6384'
          }
        ]
      }
    },
    differenceChartData() {
      return {
        labels: this.differenceData.map(item => item.month),
        datasets: [{
          label: 'Difference',
          data: this.differenceData.map(item => item.difference),
          backgroundColor: '#FFCE56'
        }]
      }
    }
  }
}
</script>

<style scoped>
h3 {
  margin-top: 20px;
  text-align: center;
}
</style>
