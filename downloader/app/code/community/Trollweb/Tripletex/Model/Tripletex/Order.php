<?php

class Trollweb_Tripletex_Model_Tripletex_Order extends Trollweb_Tripletex_Model_Tripletex_Invoice
{


    public function appendToCSV()
    {
        $header = "";
        $header .= $this->formatNumber($this->ordrenr);
        $header .= $this->formatNumber($this->ordredato);
        $header .= $this->formatNumber($this->kundenr);
        $header .= $this->formatText($this->kundenavn);
        $header .= $this->formatText($this->addresselinje1);
        $header .= $this->formatText($this->addresselinje2);
        $header .= $this->formatNumber($this->postnr);
        $header .= $this->formatText($this->poststed);
        $header .= $this->formatEpost($this->epost);
        $header .= $this->formatText($this->kontakt_fornavn);
        $header .= $this->formatText($this->kontakt_etternavn);
        $header .= $this->formatText($this->attn_fornavn);
        $header .= $this->formatText($this->attn_etternavn);
        $header .= $this->formatText($this->refnr);
        $header .= $this->formatNumber($this->leveransedato);
        $header .= $this->formatText($this->leveransested);
        $header .= $this->formatText($this->kommentar);
        $header .= $this->formatText($this->abo_enhetspris);
        $header .= $this->formatText($this->abo_enhetsperiod_enhet);
        $header .= $this->formatText($this->abo_faktureringsperiode);
        $header .= $this->formatText($this->abo_faktureringsperiode_enhet);
        $header .= $this->formatText($this->abo_forskudd_etterskudd);
        $header .= $this->formatText($this->abo_forskudd_etterskudd_enhet);
        $header .= $this->formatText($this->abo_startdato);
        
        foreach ($this->linjer as $nr => $linje) {
            $csv = $header;
            $csv .= $this->formatNumber($linje['antall']);
            $csv .= $this->formatNumber($linje['enhetspris']);
            $csv .= $this->formatNumber($linje['rabatt']);
            $csv .= $this->formatNumber($linje['mva-type']);
            $csv .= $this->formatText("");
            $csv .= $this->formatText($linje['produktnr']);
            $csv .= $this->formatText($linje['beskrivelse']);
            $csv .= $this->formatNumber($this->department); // Department number
            $csv .= $this->formatText(""); // Department name
            $csv .= $this->formatText(""); // Project number
            $csv .= $this->formatText(""); // Project name
            $csv .= $this->formatText($linje['currency']);
            
            // Clean the line
            $csv = str_replace("\t","",$csv);
            
            $this->csv[] = $csv;
        }
    }

    public function send()
    {
        $result = false;
        $api = $this->getApi();
        if ($api) {
            if ($api->importOrder(implode("\n",$this->csv)))
            {
                $result = true;
            }
            else {
                $this->setError($api->getError());
                $this->log('ERROR from API: '.$api->getError());
            }
            // Clear the CSV file.
            $this->csv = array();
        }
        return $result;
    }

}
