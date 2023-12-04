<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Button from "@/Components/Button.vue";
import { GithubIcon } from "@/Components/Icons/brands";
import PieChart from '@/Components/Chart/PieChart.vue';
</script>

<template>
    <AuthenticatedLayout title="Generate">
        <template #header>
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">Make Report</h2>
            </div>
        </template>

        <div class="p-4 overflow-hidden bg-gray-100 rounded-md shadow-md dark:bg-dark-eval-1">                       
          <div class="flex justify-between">
            <!-- Date Inputs -->
            <div class="flex space-x-4">
              <input ref="dateInput1" class="bg-blue-100 border border-gray-300 rounded-md shadow-md h-10 focus:ring-indigo-500 
                focus:border-indigo-500 dark:bg-dark-eval-2 dark:border-dark-eval-3 dark:focus:ring-dark-eval-1"
                placeholder="MM/DD/YYYY" />
              
              <span class="self-center">to</span>
              
              <input ref="dateInput2" class="bg-blue-100 border border-gray-300 rounded-md shadow-md h-10 focus:ring-indigo-500 
                focus:border-indigo-500 dark:bg-dark-eval-2 dark:border-dark-eval-3 dark:focus:ring-dark-eval-1"
                placeholder="MM/DD/YYYY" />
            </div>
            <!-- Modal -->
            <div >
              <Button variant="info" class="border border-gray-300 shadow-md dark:bg-dark-eval-2 dark:border-dark-eval-3 dark:focus:ring-dark-eval-1">
                Generate Report
              </Button>
              <ReferenceModal v-if="isModalOpen" />
            </div>
          </div>
          
            <PieChart />
        </div>
    </AuthenticatedLayout> 
</template>
<script>
import moment from 'moment';
import Pikaday from 'pikaday';
import 'pikaday/css/pikaday.css';
import ReferenceModal from '@/Components/ReferenceModal.vue';

export default {
    components: {
    ReferenceModal,
  },
  data() {
    return {
      isModalOpen: false,
    };
  },
  methods: {
    openModal() {
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
    },
  },
  mounted() {
    const dateInput1 = this.$refs.dateInput1;
    const picker1 = new Pikaday({
      field: dateInput1,
      format: 'MM/DD/YYYY',
      minDate: moment().subtract(20, 'years').toDate(),
      maxDate: moment().add(20, 'years').toDate(),
      yearRange: [moment().year() - 8, moment().year() + 1],
    });

    const dateInput2 = this.$refs.dateInput2;
    const picker2 = new Pikaday({
      field: dateInput2,
      format: 'MM/DD/YYYY',
      minDate: moment().subtract(20, 'years').toDate(),
      maxDate: moment().add(20, 'years').toDate(),
      yearRange: [moment().year() - 8, moment().year() + 1],
    });
  },
};
</script>