<template>
  <div class="relative h-full w-full">
    <div class="bg-white/10 backdrop-blur-lg w-full h-full p-4 rounded-xl">
      <h2 class="text-xl font-semibold mb-4 text-white">Statistik Delta Fishing</h2>
      <div class="relative h-[calc(100%-3rem)]">
        <canvas ref="chartCanvas"></canvas>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, onBeforeUnmount, ref } from 'vue';
import Chart from 'chart.js/auto';

const chartCanvas = ref(null);
let chartInstance = null;
let observer = null;

const props = defineProps({
  data: {
    type: Object,
    required: true
  }
});

function getThemeColors() {
    const isDarkMode = document.documentElement.classList.contains('dark');
    return {
        textColor: isDarkMode ? 'rgba(230, 230, 230, 0.9)' : 'rgba(55, 65, 81, 0.9)',
        borderColor: isDarkMode ? '#1f2937' : '#ffffff',
    };
}

function createChart() {
  if (chartCanvas.value) {
    const initialColors = getThemeColors();
    const ctx = chartCanvas.value.getContext('2d');
    chartInstance = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Users', 'Events', 'Orders', 'Sewa Alat'],
        datasets: [
          {
            label: 'Total',
            data: [
              props.data.users,
              props.data.events,
              props.data.orders,
              props.data.sewa,
            ],
            backgroundColor: [
              'rgba(75, 192, 192, 1)', // Increased opacity to 1
              'rgba(255, 206, 86, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 99, 132, 1)'
            ],
            borderColor: 'rgba(255, 255, 255, 0.5)',
            borderWidth: 2,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        layout: {
          padding: {
            right: 20
          }
        },
        plugins: {
          legend: {
            position: 'right',
            labels: {
              color: 'rgba(255, 255, 255, 1)', // Full opacity for better visibility
              padding: 15,
              font: {
                size: 13,
                weight: '600', // Slightly bolder
              },
              usePointStyle: true,
              pointStyle: 'circle',
            },
            onClick: function(e, legendItem, legend) {
              const index = legendItem.datasetIndex;
              const ci = legend.chart;
              const meta = ci.getDatasetMeta(index);
              const alreadyHidden = meta.hidden === null ? false : meta.hidden;

              ci.setDatasetVisibility(index, alreadyHidden);
              ci.update();
            },
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                const label = context.label || '';
                const value = context.parsed || 0;
                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                const percentage = ((value * 100) / total).toFixed(1);
                return `${label}: ${value} (${percentage}%)`;
              }
            },
            backgroundColor: 'rgba(0, 0, 0, 0.8)',
            titleColor: 'rgba(255, 255, 255, 1)',
            bodyColor: 'rgba(255, 255, 255, 1)',
            padding: 12,
            cornerRadius: 8
          }
        },
      },
    });
  }
}

onMounted(() => {
  createChart();

  const targetNode = document.documentElement;
  const config = { attributes: true, attributeFilter: ['class'] };

  const callback = (mutationList, observer) => {
    if (!chartInstance) return;
    const newColors = getThemeColors();
    chartInstance.options.plugins.legend.labels.color = newColors.textColor;
    chartInstance.data.datasets[0].borderColor = newColors.borderColor;
    chartInstance.update();
  };

  observer = new MutationObserver(callback);
  observer.observe(targetNode, config);
});

onBeforeUnmount(() => {
  if (chartInstance) {
    chartInstance.destroy();
  }
  if (observer) {
    observer.disconnect();
  }
});
</script>