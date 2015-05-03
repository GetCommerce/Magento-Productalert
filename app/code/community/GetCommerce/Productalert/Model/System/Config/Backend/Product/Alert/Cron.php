<?php

class GetCommerce_Productalert_Model_System_Config_Backend_Product_Alert_Cron extends Mage_Adminhtml_Model_System_Config_Backend_Product_Alert_Cron
{
    const CRON_STRING_PATH  = 'crontab/jobs/catalog_product_alert/schedule/cron_expr';
    const CRON_MODEL_PATH   = 'crontab/jobs/catalog_product_alert/run/model';

    protected function _afterSave()
    {
        $priceEnable = $this->getData('groups/productalert/fields/allow_price/value');
        $stockEnable = $this->getData('groups/productalert/fields/allow_stock/value');

        $enabled     = $priceEnable || $stockEnable;
        $frequncy    = $this->getData('groups/productalert_cron/fields/frequency/value');
        $time        = $this->getData('groups/productalert_cron/fields/time/value');

        $errorEmail  = $this->getData('groups/productalert_cron/fields/error_email/value');

        $frequencyHourly    = GetCommerce_Productalert_Model_System_Config_Source_Cron_Frequency::CRON_HOURLY;
        $frequencyDaily     = GetCommerce_Productalert_Model_System_Config_Source_Cron_Frequency::CRON_DAILY;
        //$frequencyWeekly    = Mage_Adminhtml_Model_System_Config_Source_Cron_Frequency::CRON_WEEKLY;
        $frequencyWeekly    = GetCommerce_Productalert_Model_System_Config_Source_Cron_Frequency::CRON_WEEKLY;
        //$frequencyMonthly   = Mage_Adminhtml_Model_System_Config_Source_Cron_Frequency::CRON_MONTHLY;
        $frequencyMonthly   = GetCommerce_Productalert_Model_System_Config_Source_Cron_Frequency::CRON_MONTHLY;
        $cronDayOfWeek      = date('N');

        $cronExprArray      = array(
            intval($time[1]),                                           # Minute
            ($frequncy == $frequencyHourly) ? '*' : intval($time[0]),   # Hour
            ($frequncy == $frequencyMonthly) ? '1' : '*',               # Day of the Month
            '*',                                                        # Month of the Year
            ($frequncy == $frequencyWeekly) ? '1' : '*',                # Day of the Week
        );

        $cronExprString     = join(' ', $cronExprArray);

        try {
            Mage::getModel('core/config_data')
                ->load(self::CRON_STRING_PATH, 'path')
                ->setValue($cronExprString)
                ->setPath(self::CRON_STRING_PATH)
                ->save();
            Mage::getModel('core/config_data')
                ->load(self::CRON_MODEL_PATH, 'path')
                ->setValue((string) Mage::getConfig()->getNode(self::CRON_MODEL_PATH))
                ->setPath(self::CRON_MODEL_PATH)
                ->save();
        } catch (Exception $e) {
            throw new Exception(Mage::helper('cron')->__('Unable to save the cron expression.'));
        }
    }
}
