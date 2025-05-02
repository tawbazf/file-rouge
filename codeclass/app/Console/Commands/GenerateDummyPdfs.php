<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateDummyPdfs extends Command
{
    protected $signature = 'generate:dummy-pdfs';
    protected $description = 'Generate dummy PDF files for course materials';

    public function handle()
    {
        $this->info('Generating dummy PDF files...');
        
        // Create the directory if it doesn't exist
        Storage::disk('public')->makeDirectory('course_materials');
        
        // Generate 10 dummy PDF files
        for ($i = 1; $i <= 10; $i++) {
            $this->generateDummyPdf($i);
        }
        
        $this->info('Dummy PDF files generated successfully!');
    }
    
    private function generateDummyPdf($number)
    {
        // This is a minimal valid PDF file content
        $pdfContent = "%PDF-1.4
1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj
2 0 obj<</Type/Pages/Kids[3 0 R]/Count 1>>endobj
3 0 obj<</Type/Page/MediaBox[0 0 612 792]/Resources<<>>/Contents 4 0 R/Parent 2 0 R>>endobj
4 0 obj<</Length 21>>stream
BT /F1 12 Tf 100 700 Td (Sample PDF file $number) Tj ET
endstream endobj
xref
0 5
0000000000 65535 f
0000000010 00000 n
0000000053 00000 n
0000000102 00000 n
0000000192 00000 n
trailer<</Size 5/Root 1 0 R>>
startxref
264
%%EOF";
        
        Storage::disk('public')->put("course_materials/pdf_$number.pdf", $pdfContent);
        $this->info("Generated pdf_$number.pdf");
    }
}