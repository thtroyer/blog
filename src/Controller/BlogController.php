<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{

    /**
     * @Route("/")
     * @Route("/blog")
     */
    public function blogHome($postName = "Some blog title")
    {
        return $this->render(
            'blog.html.twig',
            [
                'title' => $postName,
            ]
        );
    }

    /**
     * @Route("/blog/{postName}")
     */
    public function showPost($postName = "No title.")
    {
        $postName = "Dumque invitumque troia aquae nimbis";
        $postContents = "

## Et receptus licet

Lorem markdownum. Volant habent partem [saepe at
Orpheus](http://mentitismihi.net/aratri.aspx) cuncta velare quos mortale verum
dedisset ore et satyri sumo. Gyrum manusque! Et at spolioque supernum summos
plangore Xanthos; dubiis caelum olorinis vagans, comitum **Iovis** sine.

- Fas me boum
- Fere quo Lemnicolae movit
- Hoc luet mihi perenni
- Tanto quae curvatura lucus dolores populosque nam

Tibi rursus virga antiquam nudaverat plus corpore ante, quoniam aures lacrimas
si ille. Est resonant hoc, verba peperisse exercet opprobria Phoebi vocat
fatemur. Io esse nil adeat truncas omnibus similisque poterit invadere
spectacula decor isque primas duro plura quidem una superest Graium. Paterno
pastoria vertit!

## Stratosque multi

Diuque me servo adspicias **adhuc amplexaque taedia**. Arboris agrestis etiam te
tibi, genetrix quid. In cani tabellae petitos fortis tamen plurima est est
cognoscere aetas: ferumque magnumque est nascentur arbore.

1. Te ubera lacrimae in atque palmae telum
2. Et corpora indoluit adspexisse acta
3. Sit in silvisque ex ulvis in classe
4. Clitorio certe

Animos fuit; uterque corpora vertitis. Ut cognovit
[quaerens](http://www.nec-varios.org/gaudia). Quae animum: quem mentis nota,
*peto sed* vivere, lapsu furca scelerum umor.

## Eodem et in potuit ingreditur excepit

Per vos fibras alter iamque. Me subito solet dederat spatium, littera,
hamadryadas portus verbis, clipeum guttura ne dare adit. Femori pater puerilibus
intrarant flava exclamat cani; his comitata, conplexibus; facies amissa leones
patulis referre sumptis dixit! Herbis properantibus nepoti barbarus quis, in
ille deum confiteorque.

1. Harenosi obfuit
2. Prunaque regna
3. Erat nec
4. Moror dixere pendent est
5. Epulae umbra
6. Nocuit ostia acrior passis

Quod gutture, tuum oscula, futurae erat primi naturalique ignarus sorte quis et?
Solida **pennis quo** erroresque solibus furore.
";

        return $this->render(
            'blogpost.html.twig',
            [
                'title' => $postName,
                'post' => $postContents,
            ]
        );
    }
}