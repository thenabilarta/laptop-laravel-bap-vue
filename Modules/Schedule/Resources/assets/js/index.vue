<template>
  <div id="app">
    <div class="navigation">
      <h2>{{ selectedDate }} {{ selectedMonth }} {{ selectedYear }}</h2>
      <sui-button>Add Event</sui-button>
      <sui-dropdown
        placeholder="Select Display"
        selection
        :options="displayList"
        v-model="current"
      />
    </div>
    <div class="date-input">
      <sui-input
        placeholder="Search..."
        type="date"
        v-model="dateToday"
        @change="changeDate"
      />
      <sui-button-group>
        <sui-button
          icon="left chevron"
          label-position="left"
          content="Prev"
          @click="onClickPrev"
        />
        <sui-button content="Today" @click="onClickToday" />
        <sui-button
          icon="right chevron"
          label-position="right"
          content="Next"
          @click="onClickNext"
        />
      </sui-button-group>
      <sui-button-group>
        <sui-button>Year</sui-button>
        <sui-button @click="changeToMonth">Month</sui-button>
        <sui-button @click="changeToDay">Day</sui-button>
      </sui-button-group>
    </div>
    <main>
      <div v-if="showTable === 'month'">
        <ol class="day-of-week" id="days-of-week">
          <li class="day-list" v-for="(w, index) in weekdays" :key="index">
            {{ w }}
          </li>
        </ol>
        <ol class="days-grid" id="calendar-days">
          <li
            class="calendar-day"
            :class="c.isCurrentMonth ? '' : 'not-current'"
            v-for="(c, index) in calendarList"
            :key="index"
          >
            <span @click="toDateNumberOf(c.dayOfMonth)" class="dayNumber">{{
              c.dayOfMonth
            }}</span>
          </li>
        </ol>
      </div>
      <div class="day" v-if="showTable === 'day'">
        <sui-table striped>
          <sui-table-header>
            <sui-table-row>
              <sui-table-header-cell class="time">Time</sui-table-header-cell>
              <sui-table-header-cell class="events"
                >Events</sui-table-header-cell
              >
            </sui-table-row>
          </sui-table-header>
          <sui-table-body>
            <sui-table-row>
              <sui-table-cell class="time">00:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">00:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">01:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">01:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">02:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">02:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">03:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">03:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">04:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">04:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">05:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">05:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">06:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">06:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">07:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">07:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">08:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">08:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">09:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">09:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">10:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">10:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">11:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">11:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">12:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">12:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">13:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">13:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">14:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">14:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">15:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">15:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">16:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">16:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">17:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">17:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">18:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">18:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">19:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">19:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">20:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">20:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">21:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">21:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">22:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">22:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">23:00</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell class="time">23:30</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
          </sui-table-body>
        </sui-table>
      </div>
    </main>
  </div>
</template>

<script>
import dayjs from "dayjs";
import weekday from "dayjs/plugin/weekday";
import weekOfYear from "dayjs/plugin/weekOfYear";

import "../css/index.css";

dayjs.extend(weekday);
dayjs.extend(weekOfYear);

export default {
  name: "App",
  data() {
    return {
      INITIAL_DATE: dayjs().date(),
      INITIAL_MONTH: dayjs().month() + 1,
      INITIAL_YEAR: dayjs().year(),
      dateToday: null,
      showTable: "month",
      weekdays: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
      current: null,
      displayList: [
        {
          text: "Polytron",
          value: 1,
        },
        {
          text: "Xiaomi",
          value: 2,
        },
        {
          text: "Dell",
          value: 3,
        },
        {
          text: "Samsung",
          value: 4,
        },
      ],
    };
  },
  methods: {
    getWeekday(date) {
      return dayjs(date).weekday();
    },
    createDaysForCurrentMonth(year, month) {
      return [...Array(this.getNumberOfDaysInMonth(year, month))].map(
        (day, index) => {
          return {
            date: dayjs(`${year}-${month}-${index + 1}`).format("YYYY-MM-DD"),
            dayOfMonth: index + 1,
            isCurrentMonth: true,
          };
        }
      );
    },
    createDaysForPreviousMonth(year, month) {
      let currentMonthDays = this.createDaysForCurrentMonth(
        year,
        month,
        dayjs(`${year}-${month}-01`).daysInMonth()
      );

      const firstDayOfTheMonthWeekday = this.getWeekday(
        currentMonthDays[0].date
      );

      const previousMonth = dayjs(`${year}-${month}-01`).subtract(1, "month");

      // Cover first day of the month being sunday (firstDayOfTheMonthWeekday === 0)
      const visibleNumberOfDaysFromPreviousMonth = firstDayOfTheMonthWeekday
        ? firstDayOfTheMonthWeekday - 1
        : 6;

      const previousMonthLastMondayDayOfMonth = dayjs(currentMonthDays[0].date)
        .subtract(visibleNumberOfDaysFromPreviousMonth, "day")
        .date();

      return [...Array(visibleNumberOfDaysFromPreviousMonth)].map(
        (day, index) => {
          return {
            date: dayjs(
              `${previousMonth.year()}-${previousMonth.month() +
                1}-${previousMonthLastMondayDayOfMonth + index}`
            ).format("YYYY-MM-DD"),
            dayOfMonth: previousMonthLastMondayDayOfMonth + index,
            isCurrentMonth: false,
          };
        }
      );
    },
    createDaysForNextMonth(year, month) {
      let currentMonthDays = this.createDaysForCurrentMonth(
        year,
        month,
        dayjs(`${year}-${month}-01`).daysInMonth()
      );

      const lastDayOfTheMonthWeekday = this.getWeekday(
        `${year}-${month}-${currentMonthDays.length}`
      );

      const nextMonth = dayjs(`${year}-${month}-01`).add(1, "month");

      const visibleNumberOfDaysFromNextMonth = lastDayOfTheMonthWeekday
        ? 7 - lastDayOfTheMonthWeekday
        : lastDayOfTheMonthWeekday;

      return [...Array(visibleNumberOfDaysFromNextMonth)].map((day, index) => {
        return {
          date: dayjs(
            `${nextMonth.year()}-${nextMonth.month() + 1}-${index + 1}`
          ).format("YYYY-MM-DD"),
          dayOfMonth: index + 1,
          isCurrentMonth: false,
        };
      });
    },
    getNumberOfDaysInMonth(year, month) {
      return dayjs(`${year}-${month}-01`).daysInMonth();
    },
    changeToMonth() {
      this.showTable = "month";
    },
    changeToDay() {
      this.showTable = "day";
    },
    // changeMonth() {
    //   console.log(this.INITIAL_MONTH.value);
    // },
    toDateNumberOf(date) {
      console.log(date + " " + this.selectedMonth);
      this.showTable = "day";
      this.INITIAL_DATE = date;
      this.INITIAL_DATE.text = date;
    },
    changeDate(e) {
      this.dateToday = e.target.value;
      console.log(e.target.value);
      let splitDateToday = this.dateToday.split("-");
      this.INITIAL_DATE = splitDateToday[2];
      this.INITIAL_MONTH = splitDateToday[1];
      this.INITIAL_YEAR = splitDateToday[0];
    },
    onClickToday() {
      this.INITIAL_DATE = 11;
    },
    onClickPrev() {
      this.INITIAL_MONTH--;
      console.log(this.INITIAL_MONTH);
      this.INITIAL_MONTH = this.INITIAL_MONTH.toString();
      if (this.INITIAL_MONTH.length === 1) {
        this.INITIAL_MONTH = "0" + this.INITIAL_MONTH;
      }
      console.log(this.INITIAL_MONTH);
      this.dateToday =
        this.INITIAL_YEAR + "-" + this.INITIAL_MONTH + "-" + this.INITIAL_DATE;
      this.INITIAL_MONTH = parseInt(this.INITIAL_MONTH);
    },
    onClickNext() {
      console.log("Next");
    },
  },
  computed: {
    calendarList() {
      return [
        ...this.createDaysForPreviousMonth(
          this.INITIAL_YEAR,
          this.INITIAL_MONTH
        ),
        ...this.createDaysForCurrentMonth(
          this.INITIAL_YEAR,
          this.INITIAL_MONTH
        ),
        ...this.createDaysForNextMonth(this.INITIAL_YEAR, this.INITIAL_MONTH),
      ];
    },
    selectedDate() {
      return this.INITIAL_DATE;
    },
    selectedMonth() {
      const monthsList = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ];
      return monthsList[this.INITIAL_MONTH - 1];
    },
    selectedYear() {
      return this.INITIAL_YEAR;
    },
    defaultDateForToday() {
      return new Date().toISOString().slice(0, 10);
    },
  },
  mounted() {
    console.log(this.INITIAL_MONTH);
    this.dateToday =
      this.INITIAL_YEAR + "-" + this.INITIAL_MONTH + "-" + this.INITIAL_DATE;
  },
};
</script>
