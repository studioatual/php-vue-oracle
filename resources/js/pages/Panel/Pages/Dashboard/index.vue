<template>
  <div class="dashboard">
    <div id="chartdiv"></div>
  </div>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import * as am4core from '@amcharts/amcharts4/core';
import * as am4charts from '@amcharts/amcharts4/charts';
import am4themes_animated from '@amcharts/amcharts4/themes/animated';

export default {
  name: 'Dashboard',
  data() {
    return {
      pieSeries: null,
      pieSeries2: null,
    };
  },
  methods: {
    ...mapActions('Dashboard', ['getList']),
    init() {
      am4core.useTheme(am4themes_animated);

      let chart = am4core.create('chartdiv', am4charts.XYChart);
      chart.scrollbarX = new am4core.Scrollbar();

      chart.data = this.list;

      var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
      categoryAxis.dataFields.category = 'descricao';
      categoryAxis.renderer.grid.template.location = 0;
      categoryAxis.renderer.minGridDistance = 30;
      categoryAxis.renderer.labels.template.horizontalCenter = 'right';
      categoryAxis.renderer.labels.template.verticalCenter = 'middle';
      categoryAxis.renderer.labels.template.rotation = 270;
      categoryAxis.tooltip.disabled = true;
      categoryAxis.renderer.minHeight = 110;

      let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
      valueAxis.renderer.minWidth = 50;

      let series = chart.series.push(new am4charts.ColumnSeries());
      series.sequencedInterpolation = true;
      series.dataFields.valueY = 'custo_medio';
      series.dataFields.categoryX = 'descricao';
      series.tooltipText = '[{categoryX}: bold]{valueY}[/]';
      series.columns.template.strokeWidth = 0;

      series.tooltip.pointerOrientation = 'vertical';

      series.columns.template.column.cornerRadiusTopLeft = 10;
      series.columns.template.column.cornerRadiusTopRight = 10;
      series.columns.template.column.fillOpacity = 0.8;

      let hoverState = series.columns.template.column.states.create('hover');
      hoverState.properties.cornerRadiusTopLeft = 0;
      hoverState.properties.cornerRadiusTopRight = 0;
      hoverState.properties.fillOpacity = 1;

      series.columns.template.adapter.add('fill', function(fill, target) {
        return chart.colors.getIndex(target.dataItem.index);
      });

      chart.cursor = new am4charts.XYCursor();
    },
  },
  computed: {
    ...mapState('Dashboard', ['list']),
  },
  mounted() {
    this.getList(this.init);
  },
};
</script>
