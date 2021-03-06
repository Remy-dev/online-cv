<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Snappy\GeneratorInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBag;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Bundle\SnappyBundle\KnpSnappyBundle;
use Knp\Bundle\SnappyBundle\DependencyInjection\KnpSnappyExtension;
use Knp\Snappy\Pdf;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class PdfController extends AbstractController
{
    private $pdf;
    private $twig;
    public function __construct(Pdf $pdf, Environment $twig)
    {
        $this->pdf =$pdf;
        $this->twig = $twig;

    }

    /**
     * @Route("/", name="pdf6")
     */
    public function execute(ContainerInterface $container)
    {
        $this->pdf->setOption("enable-plugins", true);
        $this->pdf->setOption("enable-internal-links", true);
        $this->pdf->setTimeout(180);
        $this->pdf->setOption("enable-local-file-access", true);
        $this->pdf->generate('https://remy-dev.github.io/online-cv/', 'cv.pdf');

    }
    /**
     * @Route("/", name="pdf")
     *
    public function pdfAction(ContainerInterface $container)
    {
        $container->get('knp_snappy.pdf')->generate('https://remy-dev.github.io/online-cv/', 'public/pdf/cv.pdf');
        return new Response('its done');

    }
    /**
     * @Route("/", name="pdf2")
     *
    public function pdfActionTwo()
    {

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $dompdf->setBasePath('/home/glasfeu/PhpstormProjects/githubPageCv/online-cv/pdfConverter/public/images/resume_files/');
        // Retrieve the HTML generated in our twig file
        // ob_start();
        //include __DIR__.'/../../assets/images/My Resume.html';
        // $html = ob_get_clean();
        $html =  $this->renderView('base.html.twig');
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        // $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();
        $dompdf->stream();
        // Store PDF Binary Data
       // $output = $dompdf->output();

        // In this case, we want to write the file in the public directory
        // $publicDirectory = $this->get('kernel')->getProjectDir() . '/public';
        // e.g /var/www/project/public/mypdf.pdf
      //  $pdfFilepath =  '/home/glasfeu/PhpstormProjects/githubPageCv/online-cv/pdfConverter/public/cv.pdf';

        // Write file to the desired path
        //file_put_contents($pdfFilepath, $output);

        // Send some text response
       // return new Response("The PDF file has been succesfully generated !");
    }

    /**
     * @Route("/", name="pdf3")
     *
    public function pdfAction3(ContainerInterface $container)
    {
      /* $container->get('knp_snappy.pdf')->generateFromHtml(
           $this->renderView(
               'pdf/cv.html.twig'
           ),
           'cv.pdf'
       );
        $html = $this->renderView('base.html.twig');

        return new PdfResponse(
            $container->get('knp_snappy.pdf')->getOutputFromHtml($html),
            'cv.pdf'
        );
    }*/
    /**
     * @Route("/", name="pdf4")
     *
    public function pdfAction()
    {
        $pageUrl = $this->generateUrl('home', array(), true); // use absolute path!

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutput($pageUrl),
            'file.pdf'
        );
    }

    /**
     * @Route('/home', name="home")
     *
    public function home()
    {
        $this->file('../../../index.html');
    }*/
}
