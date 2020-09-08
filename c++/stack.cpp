#include<stdio.h>
#include<stdlib.h>

struct node{
	char *item;
	struct node *next;	
};

struct node *create();
void push(char *i);
char  *pop();
void print();

struct node *top=NULL;

int main(){
	while(true){
	 	int o=0;
	    printf("\nSelect One Option:\n1. Push\n2. Pop\n3. Print\nEnter Your Choice: ");
	    scanf("%d",&o);
	    switch(o){
	        case 1://push
	                printf("\nPUSH ITEM: ");
	                char *d=(char *)malloc(sizeof(char));
	                scanf("%s",d);
	                push(d);
	            break;
	        case 2://pop
					char *i=pop();
					printf("\nItem Popped: %s\n",i);
				break;
	        case 3://print
	              	printf("\nItems: ");
					print();
				break;
            default: 
					printf("\n*********** Bye *************\n");
	                exit(0);
	            break;
	
	        }	
	}
	return 0;
}

struct node *create(){
	return (struct node *)malloc(sizeof(struct node));	
}

void push(char *i){
	printf("\nBefore: ");
	print();
	struct node *n;
	n=create();
	n->item=i;
	n->next=top;
	top=n;
	printf("\nAfter: ");
	print();
}

char *pop(){
	char *c;
	if(top==NULL){
		c=(char *)"No Items";
	}else{
		c=top->item;
		top=top->next;
	}
	return c;
}

void print(){
	struct node *temp=top;
	while(temp){
		printf("%s ",temp->item);
		temp=temp->next;
	}
	printf("\n");
}